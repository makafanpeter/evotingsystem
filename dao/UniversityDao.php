<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UniversityDao
 *
 * @author Peter
 */
class UniversityDao {

    //put your code here
    /** @var PDO */
    private $db = null;

    public function __destruct() {
        // close db connection
        $this->db = null;
    }

    /**
     * Find all {@link University}s by search criteria.
     * @return array array of {@link University}s
     */
    public function find() {
        $result = array();
        foreach ($this->query($this->getFindSql()) as $row) {
            $university = new University();
            UniversityMapper::map($university, $row);
            $result[$university->getId()] = $university;
        }
        return $result;
    }

    /**
     * Find {@link University} by identifier.
     * @return University University or <i>null</i> if not found
     */
    public function findById($id) {
        $row = $this->query('SELECT * FROM universities WHERE id = ' . (int) $id)->fetch();
        $university = new University();
        if (!$row) {
            return $university;
        }

        UniversityMapper::map($university, $row);
        return $university;
    }

    /**
     * Save {@link University}.
     * @param ToDo $university {@link University} to be saved
     * @return University saved {@link University} instance
     */
    public function save(University $university) {
        if ($university->getId() === null) {
            return $this->insert($university);
        }
        return $this->update($university);
    }

    /**
     * Delete {@link University} by identifier.
     * @param int $id {@link University} identifier
     * @return bool <i>true</i> on success, <i>false</i> otherwise
     */
    public function delete($id) {
        $sql = 'DELETE  FROM universities WHERE id = :id';
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
        $sql = 'SELECT * FROM universities ';
        return $sql;
    }

    /**
     * @return University
     * @throws Exception
     */
    private function insert(University $university) {
        $now = new DateTime();
        $university->setId(null);
        $sql = '
            INSERT INTO universities (id,  name)
                VALUES (:id, :name)';
        return $this->execute($sql, $university);
    }

    /**
     * @return University
     * @throws Exception
     */
    private function update(University $university) {
        $sql = 'UPDATE universities set
            name = :name
            WHERE
                id = :id';
        return $this->execute($sql, $university);
    }

    /**
     * @return University
     * @throws Exception
     */
    private function execute($sql, University $university) {
        $mystatement = $this->showQuery($sql, $this->getParams($university));
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, $this->getParams($university));
        if (!$university->getId()) {
            return $this->findById($this->getDb()->lastInsertId());
        }
        if (!$statement->rowCount()) {
            throw new NotFoundException('University with ID "' . $university->getId() . '" does not exist.');
        }
        return $university;
    }

    private function getParams(University $university) {
        $params = array(
            ':id' => $university->getId(),
            ':name' => $university->getName()
        );
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
        // University log error, send email, etc.
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
