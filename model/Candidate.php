<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Candidate
 *
 * @author Peter
 */
class Candidate extends Person {

    //put your code here
    /**
     *
     * @var Position
     */
    
    private $position;
    
    private $voted;


    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @param Position $position
     */
    public function setPosition(Position $position){
        $this->position = $position->getId();
    }
    
    /**
     * 
     * @param type $position
     */
    public function setPositionId($position){
        $this->position = $position;
    }
    
    /**
     * 
     * @return Position
     */
    public function getPosition(){
        return $this->position;
    }
    
    /**
     * 
     * @param boolean $voted
     */
    public function setVoted($voted){
        $this->voted = (bool) $voted;
    }
    
    /**
     * 
     * @return boolean
     */
    public function getVoted(){
        return $this->voted;
    }
}

?>
