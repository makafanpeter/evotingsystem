<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DepartmentDao
 *
 * @author Peter
 */
class DepartmentDao {

    //put your code here
    /** @var PDO */
    private $db = null;

    public function __destruct() {
        // close db connection
        $this->db = null;
    }

    /**
     * Find all {@link Department}s by search criteria.
     * @return array array of {@link Department}s
     */
    public function find() {
        $result = array();
        foreach ($this->query($this->getFindSql()) as $row) {
            $department = new Department();
            DepartmentMapper::map($department, $row);
            $result[$department->getId()] = $department;
        }
        return $result;
    }

    /**
     * Find {@link Department} by identifier.
     * @return Department Department or <i>null</i> if not found
     */
    public function findById($id) {
        $row = $this->query('SELECT * FROM departments WHERE id = ' . (int) $id)->fetch();
        $department = new Department();
        if (!$row) {
            return $department;
        }

        DepartmentMapper::map($department, $row);
        return $department;
    }

    /**
     * Save {@link Department}.
     * @param ToDo $department {@link Department} to be saved
     * @return Department saved {@link Department} instance
     */
    public function save(Department $department) {
        if ($department->getId() === null) {
            return $this->insert($department);
        }
        return $this->update($department);
    }

    /**
     * Delete {@link Department} by identifier.
     * @param int $id {@link Department} identifier
     * @return bool <i>true</i> on success, <i>false</i> otherwise
     */
    public function delete($id) {
        $sql = 'DELETE  FROM departments WHERE id = :id';
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
        $sql = 'SELECT * FROM departments';
        return $sql;
    }

    /**
     * @return Department
     * @throws Exception
     */
    private function insert(Department $department) {
        $department->setId(null);
        $sql = '
            INSERT INTO departments (id,  name,Faculty_id)
                VALUES (:id, :name,:Faculty_id)';
        return $this->execute($sql, $department);
    }

    /**
     * @return Department
     * @throws Exception
     */
    private function update(Department $department) {
        $sql =
                'UPDATE departments set
            name = :name,
            Faculty_id = :Faculty_id
            WHERE
                id = :id';
        return $this->execute($sql, $department);
    }

    /**
     * @return Department
     * @throws Exception
     */
    private function execute($sql, Department $department) {
        $mystatement = $this->showQuery($sql, $this->getParams($department));
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, $this->getParams($department));
        if (!$department->getId()) {
            return $this->findById($this->getDb()->lastInsertId());
        }
        if (!$statement->rowCount()) {
            throw new NotFoundException('Department with ID "' . $department->getId() . '" does not exist.');
        }
        return $department;
    }

    private function getParams(Department $department) {
        $params = array(
            ':id' => $department->getId(),
            ':name' => $department->getName(),
            ':Faculty_id' => $department->getFacultyId()
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
        // Department log error, send email, etc.
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
