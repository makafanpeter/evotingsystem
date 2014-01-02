<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Department
 *
 * @author Peter
 */
class Department {
    //put your code here
    /**
     *
     * @var int
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
    private $facultyId;
    
    /**
     * 
     * @param int $id
     */
    public function setId($id){
        if ($this->id !== null && $this->id != $id) {
            throw new Exception('Cannot change identifier to ' . $id . ', already set to ' . $this->id);
        }
        $this->id = (int) $id;
    }
    
    /**
     * 
     * @param string $name
     */
    public function setName($name){
        $this->name = $name;
    }
    
    /**
     * 
     * @param Faculty $faculty
     */
    public function setFaculty(Faculty $faculty){
        $this->facultyId = $faculty->getId();
    }
    
    public function setFacultyId($id){
        $this->facultyId = $id;
    }
    /**
     * 
     * @return  int
     */
    public function getId(){
        return $this->id;
    }
    
    /**
     * 
     * @return string
     */
    public function getName(){
        return $this->name;
    }
    
    /**
     * 
     * @return int
     */
    public function getFacultyId(){
        return $this->facultyId;
    }

}

?>
