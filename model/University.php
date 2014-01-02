<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of University
 *
 * @author Peter
 */
class University {
    //put your code here

    /**
     * @var int id
     */
    private $id;

    /**
     * @var string name
     */
    private $name;

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
     * @param string $name
     */
    public function setName($name) {
          $this->name = $name;
    }

    /**
     * @return int Id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string name
     */
    public function getName() {
        return $this->name;
    }

}

?>
