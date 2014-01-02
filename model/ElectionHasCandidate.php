<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ElectionHasCandidate
 *
 * @author Peter
 */
class ElectionHasCandidate {
    //put your code here
   
    private $candidate;
    private $election;
    
    
    /**
     * 
     * @param type $candidate
     */
    public function setCandidate($candidate){
        $this->candidate = $candidate;
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
    public function getCandidate(){
        return $this->candidate;
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
