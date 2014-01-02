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
class ElectionHasVoter {
    //put your code here
    
   
    private $voter;
    private $election;
    
    
    
    /**
     * 
     * @param type $voter
     */
    public function setVoter($voter){
        $this->voter = $voter;
    }
    
    
    /**
     * 
     * @param type $election
     */
    public function setElection($election){
        $this->election = $election;
    }
    
    /**
     * 
     * @return type
     */
    public function getVoter(){
        return $this->voter;
    }
    
    /**
     * 
     * @return type
     */
    public function getElection(){
        return $this->election;
    }
    
}

?>
