<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Voter
 *
 * @author Peter
 */
class Voter extends Person {

    //put your code here

    private $voted;

    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @param boolean $voted
     */
    public function setVoted($voted) {
        $this->voted = (bool) $voted;
    }

    /**
     * 
     * @return boolean
     */
    public function getVoted() {
        return $this->voted;
    }

}

?>
