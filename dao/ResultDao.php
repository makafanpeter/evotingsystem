<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ResultDao
 *
 * @author Peter
 */
class ResultDao {

    //put your code here
    /** @var PDO */
    private $db = null;

    public function __destruct() {
        // close db connection
        $this->db = null;
    }

    /**
     * Find all {@link Result}s by search criteria.
     * @return array array of {@link Result}s
     */
    public function find() {
        $result = array();
        foreach ($this->query($this->getFindSql()) as $row) {
            $result = new Result();
            ResultMapper::map($result, $row);
            $result[$result->getId()] = $result;
        }
        return $result;
    }

    /**
     * Find {@link Result} by identifier.
     * @return Result Result or <i>null</i> if not found
     */
    public function findById($id) {
        $row = $this->query('SELECT * FROM results WHERE id = ' . (int) $id)->fetch();
        $result = new Result();
        if (!$row) {
            return $result;
        }

        ResultMapper::map($result, $row);
        return $result;
    }

    /**
     * 
     * @return int
     */
    public function TotalVotersThatVoted() {
        $row = $this->query('SELECT count(*) as counts FROM voters WHERE isvoted = 1')->fetch();
        return $row['counts'];
    }
    
    /**
     * 
     * @return int
     */
    public function TotalCandidateThatVoted() {
        $row = $this->query('SELECT count(*)as counts FROM candidates WHERE isvoted = 1')->fetch();
        return $row['counts'];
    }

    /**
     * Save {@link Result}.
     * @param ToDo $result {@link Result} to be saved
     * @return Result saved {@link Result} instance
     */
    public function save(Candidate $candidate) {

        return $this->insert($candidate);
    }

    /**
     * Delete {@link Result} by identifier.
     * @param int $id {@link Result} identifier
     * @return bool <i>true</i> on success, <i>false</i> otherwise
     */
    public function delete($id) {
        $sql = 'DELETE  FROM results WHERE id = :id';
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
        $sql = 'SELECT * FROM results';
        return $sql;
    }

    /**
     * @return Result
     * @throws Exception
     */
    private function insert(Candidate $candidate) {
        $sql = 'INSERT INTO results SET candidate_id = :candidate_id, position_id = :position_id ON DUPLICATE KEY UPDATE votecount=votecount+1';
        return $this->execute($sql, $candidate);
    }

    /**
     * 
     * @param Position $position
     * @param type $university
     * @param type $faculty
     * @param type $department
     * @return type
     */
    public function count(Position $position, $university, $faculty, $department) {
        $results = array();
        foreach ($this->query($this->getCountSql($position, $university, $faculty, $department)) as $row) {
            $result = new Result();
            ResultMapper::map($result, $row);
            $results[$result->getId()] = $result;
        }
        return $results;
    }

    /**
     * 
     * @param Position $position
     * @param type $university
     * @param type $faculty
     * @param type $department
     * @return string
     */
    private function getCountSql(Position $position, $university, $faculty, $department) {
        $sql = "select r.id, 
            concat(c.firstname,' ',c.lastname) as name, r.votecount from results as r 
            Left join candidates as c on r.candidate_id= c.id
left join positions as p on r.position_id = p.id ";
        switch ($position->PositionLevel()) {
            case 3:
                $sql .= "WHERE c.University_id = {$university} and p.id = {$position->getId()}";
                break;

            case 2:
                $sql .= "WHERE c.Faculty_id = {$faculty} and p.id = {$position->getId()}";
                break;
            case 1:
                $sql .= "WHERE c.department_id = {$department} and p.id = {$position->getId()}";
                break;
        }

        return $sql;
    }

    /**
     * 
     * @param Position $position
     * @return type
     */
    public function report(Position $position) {
        $results = array();
        foreach ($this->query($this->getReportSql($position)) as $row) {
            $result = new Result();
            ResultMapper::map($result, $row);
            $results[$result->getId()] = $result;
        }
        return $results;
    }

    private function getReportSql(Position $position) {
        $sql = "select r.id, 
            concat(c.firstname,' ',c.lastname) as name, r.votecount from results as r 
            Left join candidates as c on r.candidate_id= c.id
left join positions as p on r.position_id = p.id ";
        switch ($position->PositionLevel()) {
            case 3:
                $sql .= "WHERE p.level = {$position->PositionLevel()} and p.id ={$position->getId()}";
                break;
            case 2:
                $sql .= "WHERE p.level = {$position->PositionLevel()} and p.id ={$position->getId()}";
                break;
            case 1:
                $sql .= "WHERE p.level = {$position->PositionLevel()} and p.id ={$position->getId()}";
                break;
        }

        return $sql;
    }

    /**
     * @return Result
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
            throw new NotFoundException('Result with ID "' . $candidate->getId() . '" does not exist.');
        }
        return $candidate;
    }

    private function getParams(Candidate $candidate) {
        $params = array(
            ':candidate_id' => $candidate->getId(),
            ':position_id' => $candidate->getPosition()
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
        // Result log error, send email, etc.
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
