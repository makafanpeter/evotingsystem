<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VoterDao
 *
 * @author Peter
 */
class VoterDao {
    //put your code here
    /** @var PDO */
    private $db = null;

    public function __destruct() {
        // close db connection
        $this->db = null;
    }

    /**
     * Find all {@link Voter}s by search criteria.
     * @return array array of {@link Voter}s
     */
    public function find() {
        $result = array();
        foreach ($this->query($this->getFindSql()) as $row) {
            $voter = new Voter();
            VoterMapper::map($voter, $row);
            $result[$voter->getId()] = $voter;
        }
        return $result;
    }

    /**
     * Find {@link Voter} by identifier.
     * @return Voter Voter or <i>null</i> if not found
     */
    public function findById($id) {
        $row = $this->query('SELECT * FROM voters WHERE id = ' . (int) $id)->fetch();
        if (!$row) {
            return null;
        }
        $voter = new Voter();
        VoterMapper::map($voter, $row);
        return $voter;
    }

    /**
     * Find {@link Voter} by matricNumber.
     * @return Voter Voter or <i>null</i> if not found
     */
    public function findByMatricNumber($matricNumber) {
        $sql = $this->getDb()->prepare('SELECT * FROM voters WHERE matricNumber = ?');
        $sql->execute(array($matricNumber));
        $row = $sql->fetch();
        $voter = new Voter();
        if (!$row) {
            return $voter;
        }

        VoterMapper::map($voter, $row);
        return $voter;
    }

    /**
     * Save {@link Voter}.
     * @param ToDo $voter {@link Voter} to be saved
     * @return Voter saved {@link Voter} instance
     */
    public function save(Voter $voter) {
        if ($voter->getId() === null) {
            return $this->insert($voter);
        }
        return $this->update($voter);
    }

    /**
     * Delete {@link Voter} by identifier.
     * @param int $id {@link Voter} identifier
     * @return bool <i>true</i> on success, <i>false</i> otherwise
     */
    public function delete($id) {
        $sql = 'DELETE  FROM voters WHERE id = :id';
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
        $sql = 'SELECT * FROM voters ';
        return $sql;
    }

    /**
     * @return Voter
     * @throws Exception
     */
    private function insert(Voter $voter) {
        $now = new DateTime();
        $voter->setId(null);
        $voter->setCreatedOn($now);
        $voter->setLastModifiedOn($now);
        $voter->setVoted(false);
        $sql = '
            INSERT INTO voters (id,  matricnumber, firstname,lastname,othernames,password,isvoted,created_on,last_modified_on,department_id,Faculty_id,University_id)
                VALUES (:id, :matricNumber, :firstName, :lastName, :otherNames, :password, :isvoted, :created_on, :last_modified_on, :department_id,:Faculty_id,:University_id)';
        return $this->execute($sql, $voter);
    }

    /**
     * @return Voter
     * @throws Exception
     */
    private function update(Voter $voter) {
        $voter->setLastModifiedOn(new DateTime());
        $sql = '
            UPDATE 
            voters SET
                firstname = :firstName,
                lastname = :lastName,
                othernames = :otherNames,
                password = :password,
                last_modified_on = :last_modified_on,
                isvoted = :isvoted
            WHERE
                id = :id';
        return $this->execute($sql, $voter);
    }

    /**
     * @return Voter
     * @throws Exception
     */
    private function execute($sql, Voter $voter) {
        $mystatement = $this->showQuery($sql, $this->getParams($voter));
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, $this->getParams($voter));
        if (!$voter->getId()) {
            return $this->findById($this->getDb()->lastInsertId());
        }
        if (!$statement->rowCount()) {
            throw new NotFoundException('Voter with ID "' . $voter->getId() . '" does not exist.');
        }
        return $voter;
    }

    private function getParams(Voter $voter) {
        $params = array(
            ':id' => $voter->getId(),
            ':matricNumber' => $voter->getMatricNumber(),
            ':firstName' => $voter->getFirstName(),
            ':lastName' => $voter->getLastName(),
            ':otherNames' => $voter->getOtherNames(),
            ':created_on' => self::formatDateTime($voter->getCreatedOn()),
            ':isvoted' => (int)$voter->getVoted(),
            ':last_modified_on' => self::formatDateTime($voter->getLastModifiedOn()),
            ':password' => $voter->getPassword(),
            ':department_id' => $voter->getDepartment(),
            ':Faculty_id' => $voter->getFaculty(),
            ':University_id' => $voter->getUniversity(),
        );
        if ($voter->getId()) {
            // unset created date, this one is never updated
            unset($params[':created_on']);
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
        // Voter log error, send email, etc.
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
