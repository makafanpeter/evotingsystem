<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CandidateDao
 *
 * @author Peter
 */
class CandidateDao {

    //put your code here
    /** @var PDO */
    private $db = null;

    public function __destruct() {
        // close db connection
        $this->db = null;
    }

    /**
     * Find all {@link Candidate}s.
     * @return array array of {@link Candidate}s
     */
    public function findAll() {
        $result = array();
        foreach ($this->query($this->getFindAllSql()) as $row) {
            $candidate = new Candidate();
            CandidateMapper::map($candidate, $row);
            $result[$candidate->getId()] = $candidate;
        }
        return $result;
    }

    /**
     * Find all {@link Candidate}s by search criteria
     * @return \Candidate
     */
    public function find(Position $position, $university, $faculty, $department) {
        $result = array();

        foreach ($this->query($this->getFindSql($position, $university, $faculty, $department)) as $row) {
            $candidate = new Candidate();
            CandidateMapper::map($candidate, $row);
            $result[$candidate->getId()] = $candidate;
        }
        return $result;
    }

    /**
     * Find {@link Candidate} by identifier.
     * @return Candidate Candidate or <i>null</i> if not found
     */
    public function findById($id) {
        $row = $this->query('SELECT * FROM candidates WHERE id = ' . (int) $id)->fetch();
        $candidate = new Candidate();
        if (!$row) {
            return $candidate;
        }
        CandidateMapper::map($candidate, $row);
        return $candidate;
    }

    /**
     * Find {@link Candidate} by matricNumber.
     * @return Candidate Candidate or <i>null</i> if not found
     */
    public function findByMatricNumber($matricNumber) {
        $sql = $this->getDb()->prepare('SELECT * FROM candidates WHERE matricNumber = ?');
        $sql->execute(array($matricNumber));
        $row = $sql->fetch();
        $candidate = new Candidate();
        if (!$row) {
            return $candidate;
        }

        CandidateMapper::map($candidate, $row);
        return $candidate;
    }

    /**
     * Save {@link Candidate}.
     * @param ToDo $candidate {@link Candidate} to be saved
     * @return Candidate saved {@link Candidate} instance
     */
    public function save(Candidate $candidate) {
        if ($candidate->getId() === null) {
            return $this->insert($candidate);
        }
        return $this->update($candidate);
    }

    /**
     * Delete {@link Candidate} by identifier.
     * @param int $id {@link Candidate} identifier
     * @return bool <i>true</i> on success, <i>false</i> otherwise
     */
    public function delete($id) {
        $sql = 'DELETE  FROM candidates WHERE id = :id';
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

    /**
     * 
     * @return string
     */
    private function getFindAllSql() {
        $sql = 'SELECT * FROM candidates ';
        return $sql;
    }

    private function getFindSql(Position $position, $university, $faculty, $department) {
        $sql = 'SELECT candidates.id,candidates.matricNumber,candidates.firstname ,
            candidates.lastname,candidates.othernames,candidates.password,
            candidates.isvoted,candidates.created_on,candidates.last_modified_on,candidates.department_id
            ,candidates.University_id,candidates.Faculty_id,candidates.position_id
            FROM candidates,positions WHERE ';
        switch ($position->PositionLevel()) {
            case 3:
                $sql .= "candidates.University_id = {$university} and 
candidates.position_id = {$position->getId()} and 
(positions.level = {$position->PositionLevel()} and positions.id = {$position->getId()})";
                break;
            case 2:
                $sql .= "candidates.Faculty_id = {$faculty} and 
candidates.position_id = {$position->getId()} and 
(positions.level = {$position->PositionLevel()} and positions.id = {$position->getId()})";
                break;
            case 1:
                $sql .= "candidates.department_id = {$department} and 
candidates.position_id = {$position->getId()} and 
(positions.level = {$position->PositionLevel()} and positions.id = {$position->getId()})";
                break;
        }
        return $sql;
    }

    /**
     * @return Candidate
     * @throws Exception
     */
    private function insert(Candidate $candidate) {
        $now = new DateTime();
        $candidate->setId(null);
        $candidate->setCreatedOn($now);
        $candidate->setLastModifiedOn($now);
        $candidate->setVoted(false);
        $sql = '
            INSERT INTO candidates (id, matricNumber, firstName,lastName,otherNames,password,isvoted,created_on,last_modified_on,department_id,Faculty_id,University_id,position_id)
                VALUES (:id, :matricNumber, :firstName, :lastName, :otherNames, :password, :isvoted, :created_on, :last_modified_on, :department_id,:Faculty_id,:University_id,:position_id)';
        return $this->execute($sql, $candidate);
    }

    /**
     * @return Candidate
     * @throws Exception
     */
    private function update(Candidate $candidate) {
        $candidate->setLastModifiedOn(new DateTime());
        $sql = '
            UPDATE candidates SET
                firstname = :firstName,
                lastname = :lastName,
                othernames = :otherNames,
                password = :password,
                last_modified_on = :last_modified_on,
                isvoted = :isvoted
            WHERE
                id = :id';
        return $this->execute($sql, $candidate);
    }

    /**
     * @return Candidate
     * @throws Exception
     */
    private function execute($sql, Candidate $candidate) {
        $mystatement = $this->showQuery($sql, $this->getParams($candidate));
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, $this->getParams($candidate));
        if (!$candidate->getId()) {
            return $this->findById($this->getDb()->lastInsertId());
        }
        if (!$statement->rowCount()) {
            throw new NotFoundException('Candidate with ID "' . $candidate->getId() . '" does not exist.');
        }
        return $candidate;
    }

    private function getParams(Candidate $candidate) {
        $params = array(
            ':id' => $candidate->getId(),
            ':matricNumber' => $candidate->getMatricNumber(),
            ':firstName' => $candidate->getFirstName(),
            ':lastName' => $candidate->getLastName(),
            ':otherNames' => $candidate->getOtherNames(),
            ':created_on' => self::formatDateTime($candidate->getCreatedOn()),
            ':isvoted' => (int) $candidate->getVoted(),
            ':last_modified_on' => self::formatDateTime($candidate->getLastModifiedOn()),
            ':password' => $candidate->getPassword(),
            ':department_id' => $candidate->getDepartment(),
            ':Faculty_id' => $candidate->getFaculty(),
            ':University_id' => $candidate->getUniversity(),
            ':position_id' => $candidate->getPosition()
        );
        if ($candidate->getId()) {
            // unset created date, this one is never updated
            unset($params[':created_on']);
            unset($params[':University_id']);
            unset($params[':Faculty_id']);
            unset($params[':department_id']);
            unset($params[':matricNumber']);
            unset($params[':position_id']);
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
        // Candidate log error, send email, etc.
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
