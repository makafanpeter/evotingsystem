<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * DAO for {@link Administrator}.
 * <p>
 * It is also a service, ideally, this class should be divided into DAO and Service.
 */
class AdministratorDao {

    //put your code here
    /** @var PDO */
    private $db = null;

    public function __destruct() {
        // close db connection
        $this->db = null;
    }

    /**
     * Find all {@link Administrator}s by search criteria.
     * @return array array of {@link Administrator}s
     */
    public function find() {
        $result = array();
        foreach ($this->query($this->getFindSql()) as $row) {
            $administrator = new Administrator();
            AdministratorMapper::map($administrator, $row);
            $result[$administrator->getId()] = $administrator;
        }
        return $result;
    }

    /**
     * Find {@link Administrator} by identifier.
     * @return Administrator Administrator or <i>null</i> if not found
     */
    public function findById($id) {
        $row = $this->query('SELECT * FROM administrators WHERE id = ' . (int) $id)->fetch();
        if (!$row) {
            return null;
        }
        $administrator = new Administrator();
        AdministratorMapper::map($administrator, $row);
        return $administrator;
    }

    /**
     * Find {@link Administrator} by matricNumber.
     * @return Administrator Administrator or <i>null</i> if not found
     */
    public function findByMatricNumber($matricNumber) {
        $sql = $this->getDb()->prepare('SELECT * FROM administrators WHERE matricNumber = ?');
        $sql->execute(array($matricNumber));
        $row = $sql->fetch();
        $administrator = new Administrator();
        if (!$row) {
            return $administrator;
        }

        AdministratorMapper::map($administrator, $row);
        return $administrator;
    }

    /**
     * Save {@link Administrator}.
     * @param ToDo $administrator {@link Administrator} to be saved
     * @return Administrator saved {@link Administrator} instance
     */
    public function save(Administrator $administrator) {
        if ($administrator->getId() === null) {
            return $this->insert($administrator);
        }
        return $this->update($administrator);
    }

    /**
     * Delete {@link Administrator} by identifier.
     * @param int $id {@link Administrator} identifier
     * @return bool <i>true</i> on success, <i>false</i> otherwise
     */
    public function delete($id) {
        $sql = 'DELETE  FROM administrators WHERE id = :id';
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, array(':id' => $id,));
        return $statement->rowCount() == 1;
    }

    /**
     * @return PDO
     */
    private function getDb() {
        if ($this->db !== null) {
            return $this->db;
        }
        $config = Config::getConfig("db");
        try {
            $this->db = new PDO($config['dsn'], $config['username'], $config['password']);
        } catch (Exception $ex) {
            throw new Exception('DB connection error: ' . $ex->getMessage());
        }
        return $this->db;
    }

    private function getFindSql() {
        $sql = 'SELECT * FROM administrators ';
        return $sql;
    }

    /**
     * @return Administrator
     * @throws Exception
     */
    private function insert(Administrator $administrator) {
        $now = new DateTime();
        $administrator->setId(null);
        $administrator->setCreatedOn($now);
        $administrator->setLastModifiedOn($now);
        $sql = '
            INSERT INTO administrators (id,  matricNumber, firstName,lastName,otherNames,password,role,created_on,last_modified_on,department_id,Faculty_id,University_id)
                VALUES (:id, :matricNumber, :firstName, :lastName, :otherNames, :password, :role, :created_on, :last_modified_on, :department_id,:Faculty_id,:University_id)';
        return $this->execute($sql, $administrator);
    }

    /**
     * @return Administrator
     * @throws Exception
     */
    private function update(Administrator $administrator) {
        $administrator->setLastModifiedOn(new DateTime());
        $sql = '
            UPDATE 
            administrators SET
                firstname = :firstName,
                lastname = :lastName,
                othernames = :otherNames,
                password = :password,
                last_modified_on = :last_modified_on
            WHERE
                id = :id';
        return $this->execute($sql, $administrator);
    }

    /**
     * @return Administrator
     * @throws Exception
     */
    private function execute($sql, Administrator $administrator) {
        $mystatement = $this->showQuery($sql, $this->getParams($administrator));
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, $this->getParams($administrator));
        if (!$administrator->getId()) {
            return $this->findById($this->getDb()->lastInsertId());
        }
        if (!$statement->rowCount()) {
            throw new NotFoundException('Administrator with ID "' . $administrator->getId() . '" does not exist.');
        }
        return $administrator;
    }

    private function getParams(Administrator $administrator) {
        $params = array(
            ':id' => $administrator->getId(),
            ':matricNumber' => $administrator->getMatricNumber(),
            ':firstName' => $administrator->getFirstName(),
            ':lastName' => $administrator->getLastName(),
            ':otherNames' => $administrator->getOtherNames(),
            ':created_on' => self::formatDateTime($administrator->getCreatedOn()),
            ':role' => $administrator->getRole(),
            ':last_modified_on' => self::formatDateTime($administrator->getLastModifiedOn()),
            ':password' => $administrator->getPassword(),
            ':department_id' => $administrator->getDepartment(),
            ':Faculty_id' => $administrator->getFaculty(),
            ':University_id' => $administrator->getUniversity(),
        );
        if ($administrator->getId()) {
            // unset created date, this one is never updated
            unset($params[':created_on']);
            unset($params[':role']);
            unset($params[':University_id']);
            unset($params[':Faculty_id']);
            unset($params[':department_id']);
            unset($params[':matricNumber']);
        }
        return $params;
    }

    private function executeStatement(PDOStatement $statement, array $params) {
        $this->bindArrayValue($statement, $params, TRUE);
        if (!$statement->execute()) {
            self::throwDbError($this->getDb()->errorInfo());
        }
    }

    /**
     * @return PDOStatement
     */
    private function query($sql) {
        $statement = $this->getDb()->query($sql, PDO::FETCH_ASSOC);
        if ($statement === false) {
            self::throwDbError($this->getDb()->errorInfo());
        }
        return $statement;
    }

    private static function throwDbError(array $errorInfo) {
        // Administrator log error, send email, etc.
        throw new Exception('DB error [' . $errorInfo[0] . ', ' . $errorInfo[1] . ']: ' . $errorInfo[2]);
    }

    private static function formatDateTime(DateTime $date) {
        return $date->format('Y-m-d H:i:s');
    }

    private static function bindArrayValue(&$req, $array, $typeArray = false) {
        if (is_object($req) && ($req instanceof PDOStatement)) {
            foreach ($array as $key => $value) {
                if ($typeArray)
                    $req->bindValue("$key", $value, $typeArray[$key]);
                else {
                    if (is_int($value))
                        $param = PDO::PARAM_INT;
                    elseif (is_bool($value))
                        $param = PDO::PARAM_BOOL;
                    elseif (is_null($value))
                        $param = PDO::PARAM_NULL;
                    elseif (is_string($value))
                        $param = PDO::PARAM_STR;
                    else
                        $param = FALSE;

                    if ($param)
                        $req->bindValue("$key", $value, $param);
                }
            }
        }
    }

    public function showQuery($query, $params) {
        $keys = array();
        $values = array();

        # build a regular expression for each parameter
        foreach ($params as $key => $value) {
            if (is_string($key)) {
                $keys[] = '/' . $key . '/';
            } else {
                $keys[] = '/[?]/';
            }

            if (is_numeric($value)) {
                $values[] = intval($value);
            } else {
                $values[] = '"' . $value . '"';
            }
        }

        $query = preg_replace($keys, $values, $query, 1, $count);
        return $query;
    }

}

?>
