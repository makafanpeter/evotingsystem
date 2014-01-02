<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PositionDao
 *
 * @author Peter
 */
class PositionDao {
    //put your code here
    /** @var PDO */
    private $db = null;

    public function __destruct() {
        // close db connection
        $this->db = null;
    }

    /**
     * Find all {@link Position}s by search criteria.
     * @return array array of {@link Position}s
     */
    public function find() {
        $result = array();
        foreach ($this->query($this->getFindSql()) as $row) {
            $position = new Position();
            PositionMapper::map($position, $row);
            $result[$position->getId()] = $position;
        }
        return $result;
    }

    /**
     * Find {@link Position} by identifier.
     * @return Position Position or <i>null</i> if not found
     */
    public function findById($id) {
        $row = $this->query('SELECT * FROM positions WHERE id = ' . (int) $id)->fetch();
        $position = new Position();
        if (!$row) {
            return $position;
        }

        PositionMapper::map($position, $row);
        return $position;
    }

    /**
     * Save {@link Position}.
     * @param ToDo $position {@link Position} to be saved
     * @return Position saved {@link Position} instance
     */
    public function save(Position $position) {
        if ($position->getId() === null) {
            return $this->insert($position);
        }
        return $this->update($position);
    }

    /**
     * Delete {@link Position} by identifier.
     * @param int $id {@link Position} identifier
     * @return bool <i>true</i> on success, <i>false</i> otherwise
     */
    public function delete($id) {
        $sql = 'DELETE  FROM positions WHERE id = :id';
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
        $sql = 'SELECT * FROM positions';
        return $sql;
    }

    /**
     * @return Position
     * @throws Exception
     */
    private function insert(Position $position) {
        $position->setId(null);
        $sql = '
            INSERT INTO positions (id,  name,level)
                VALUES (:id, :name,:level)';
        return $this->execute($sql, $position);
    }

    /**
     * @return Position
     * @throws Exception
     */
    private function update(Position $position) {
        $sql = 'UPDATE positions set
            name = :name,
            level = :level
            WHERE
                id = :id';
        return $this->execute($sql, $position);
    }

    /**
     * @return Position
     * @throws Exception
     */
    private function execute($sql, Position $position) {
        $mystatement = $this->showQuery($sql, $this->getParams($position));
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, $this->getParams($position));
        if (!$position->getId()) {
            return $this->findById($this->getDb()->lastInsertId());
        }
        if (!$statement->rowCount()) {
            throw new NotFoundException('Position with ID "' . $position->getId() . '" does not exist.');
        }
        return $position;
    }

    private function getParams(Position $position) {
        $params = array(
            ':id' => $position->getId(),
            ':name' => $position->getName(),
            ':level' => $position->getPositionLevel()
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
        // Position log error, send email, etc.
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
