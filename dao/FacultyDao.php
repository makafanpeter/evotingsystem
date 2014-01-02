<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FacultyDao
 *
 * @author Peter
 */
class FacultyDao {

    //put your code here
    /** @var PDO */
    private $db = null;

    public function __destruct() {
        // close db connection
        $this->db = null;
    }

    /**
     * Find all {@link Faculty}s by search criteria.
     * @return array array of {@link Faculty}s
     */
    public function find() {
        $result = array();
        foreach ($this->query($this->getFindSql()) as $row) {
            $faculty = new Faculty();
            FacultyMapper::map($faculty, $row);
            $result[$faculty->getId()] = $faculty;
        }
        return $result;
    }

    /**
     * Find {@link Faculty} by identifier.
     * @return Faculty Faculty or <i>null</i> if not found
     */
    public function findById($id) {
        $row = $this->query('SELECT * FROM faculties WHERE id = ' . (int) $id)->fetch();
        $faculty = new Faculty();
        if (!$row) {
            return $faculty;
        }

        FacultyMapper::map($faculty, $row);
        return $faculty;
    }

    /**
     * Save {@link Faculty}.
     * @param ToDo $faculty {@link Faculty} to be saved
     * @return Faculty saved {@link Faculty} instance
     */
    public function save(Faculty $faculty) {
        if ($faculty->getId() === null) {
            return $this->insert($faculty);
        }
        return $this->update($faculty);
    }

    /**
     * Delete {@link Faculty} by identifier.
     * @param int $id {@link Faculty} identifier
     * @return bool <i>true</i> on success, <i>false</i> otherwise
     */
    public function delete($id) {
        $sql = 'DELETE  FROM faculties WHERE id = :id';
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
        $sql = 'SELECT * FROM faculties';
        return $sql;
    }

    /**
     * @return Faculty
     * @throws Exception
     */
    private function insert(Faculty $faculty) {
        $faculty->setId(null);
        $sql = '
            INSERT INTO faculties (id,  name,University_id)
                VALUES (:id, :name,:University_id)';
        return $this->execute($sql, $faculty);
    }

    /**
     * @return Faculty
     * @throws Exception
     */
    private function update(Faculty $faculty) {
        $sql = 'UPDATE faculties set
            name = :name,
            University_id = :University_id
            WHERE
                id = :id';
        return $this->execute($sql, $faculty);
    }

    /**
     * @return Faculty
     * @throws Exception
     */
    private function execute($sql, Faculty $faculty) {
        $mystatement = $this->showQuery($sql, $this->getParams($faculty));
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, $this->getParams($faculty));
        if (!$faculty->getId()) {
            return $this->findById($this->getDb()->lastInsertId());
        }
        if (!$statement->rowCount()) {
            throw new NotFoundException('Faculty with ID "' . $faculty->getId() . '" does not exist.');
        }
        return $faculty;
    }

    private function getParams(Faculty $faculty) {
        $params = array(
            ':id' => $faculty->getId(),
            ':name' => $faculty->getName(),
            ':University_id' => $faculty->getUniversityId()
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
        // Faculty log error, send email, etc.
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
