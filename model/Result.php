<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Result
 *
 * @author Peter
 */
class Result {

    //put your code here
    /**
     *
     * @var type 
     */
    private $id;

    /**
     *
     * @var type 
     */
    private $candidate;

    /**
     *
     * @var type 
     */
    private $position;

    /**
     *
     * @var type 
     */
    private $count;

    /**
     *
     * @var type 
     */
    private $datecreated;

    public function __construct() {
        $now = new DateTime();
        $this->setCreatedOn($now);
    }

    /**
     * 
     * @param type $id
     * @throws Exception
     */
    public function setId($id) {
        if ($this->id !== null && $this->id != $id) {
            throw new Exception('Cannot change identifier to ' . $id . ', already set to ' . $this->id);
        }
        $this->id = (int) $id;
    }

    /**
     * 
     * @param type $name
     */
    public function setCandidate($name) {
        $this->candidate = $name;
    }

    /**
     * 
     * @param int $count
     */
    public function setCount($count) {
        $this->count = $count;
    }

    /**
     * 
     * @param type $id
     */
    public function setPosition($name) {
        $this->position = $name;
    }

    /**
     * 
     * @param type $datecreated
     */
    public function setCreatedOn($datecreated) {
        $this->datecreated = $datecreated;
    }

    /**
     * 
     * @return type
     */
    public function getId() {
        return $this->id;
    }

    /**
     * 
     * @return type
     */
    public function getCandidate() {
        return $this->candidate;
    }

    /**
     * 
     * @return type
     */
    public function getPosition() {
        return $this->position;
    }

    /**
     * 
     * @return int
     */
    public function getCount() {
        return $this->count;
    }

    /**
     * 
     * @return type
     */
    public function getCreatedOn() {
        return $this->datecreated;
    }

}

?>
