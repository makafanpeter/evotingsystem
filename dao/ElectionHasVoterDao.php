<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ElectionHasVoter
 *
 * @author Peter
 */
class ElectionHasVoterDao {

    //put your code here
    /** @var PDO */
    private $db = null;

    public function __destruct() {
        // close db connection
        $this->db = null;
    }

    /**
     * Find all {@link Election}s by search criteria.
     * @return array array of {@link Election}s
     */
    public function find() {
        $result = array();
        foreach ($this->query($this->getFindSql()) as $row) {
            $election = new Election();
            ElectionMapper::map($election, $row);
            $result[$election->getId()] = $election;
        }
        return $result;
    }

    /**
     * Find {@link Election} by identifier.
     * @return Election Election or <i>null</i> if not found
     */
    public function findById($id) {
        $row = $this->query('SELECT * FROM elections_has_voters WHERE Voters_id = ' . (int) $id)->fetch();
        $election = new ElectionHasVoter();
        if (!$row) {
            return $election;
        }

        ElectionHasVoterMapper::map($election, $row);
        return $election;
    }

    /**
     * Save {@link Election}.
     * @param ToDo $election {@link Election} to be saved
     * @return Election saved {@link Election} instance
     */
    public function save(ElectionHasVoter $election) {

        return $this->insert($election);
    }

    /**
     * Delete {@link Election} by identifier.
     * @param int $id {@link Election} identifier
     * @return bool <i>true</i> on success, <i>false</i> otherwise
     */
    public function delete($id) {
        $sql = 'DELETE  FROM elections_has_voters WHERE Voters_id = :voter_id';
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
        $sql = 'SELECT * FROM elections_has_voters';
        return $sql;
    }

    /**
     * @return Election
     * @throws Exception
     */
    private function insert(ElectionHasVoter $election) {
        $sql = '
            INSERT INTO elections_has_voters (elections_id,voters_id)
                VALUES (:election_id, :voter_id)';
        return $this->execute($sql, $election);
    }

    /**
     * @return Election
     * @throws Exception
     */
    private function update(ElectionHasVoter $election) {
        $sql = '';
        return $this->execute($sql, $election);
    }

    /**
     * @return Election
     * @throws Exception
     */
    private function execute($sql, ElectionHasVoter $election) {
        $mystatement = $this->showQuery($sql, $this->getParams($election));
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, $this->getParams($election));
        if (!$election->getVoter()) {
            return $this->findById($this->getDb()->lastInsertId());
        }
        if (!$statement->rowCount()) {
            throw new NotFoundException('Election with ID "' . $election->getVoter() . '" does not exist.');
        }
        return $election;
    }

    private function getParams(ElectionHasVoter $election) {
        $params = array(
            ':election_id' => $election->getElection(),
            ':voter_id' => $election->getVoter()
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
        // Election log error, send email, etc.
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
