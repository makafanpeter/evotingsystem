<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Faculty
 *
 * @author Peter
 */
class Faculty {

    //put your code here
    /**
     * @var int ID
     */
    private $id;

    /**
     *
     * @var string
     */
    private $name;

    /**
     *
     * @var int
     */
    private $universityId;

    /**
     * 
     * @param int $id
     */
    public function setId($id) {
        if ($this->id !== null && $this->id != $id) {
            throw new Exception('Cannot change identifier to ' . $id . ', already set to ' . $this->id);
        }
        $this->id = (int) $id;
    }

    /**
     * 
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * 
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * 
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * 
     * @param University $university
     */
    public function setUniversity(University $university) {
        $this->universityId = $university->getId();
    }

    /**
     * 
     * @param int $id
     */
    public function setUniversityId($id) {
        $this->universityId = $id;
    }

    /**
     * 
     * @return int
     */
    public function getUniversityId() {
        return $this->universityId;
    }

}
?>
