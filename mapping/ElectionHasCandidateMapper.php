<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ElectionHasCandidateMapper
 *
 * @author Peter
 */
class ElectionHasCandidateMapper {
    //put your code here
    public function __construct() {
        
    }

    public static function map(ElectionHasCandidate $electionHasCandidate, array $properties) {
        if (array_key_exists('candidates_id', $properties)) {
            $electionHasCandidate->setCandidate($properties['candidates_id']);
        }
        if (array_key_exists('elections_id', $properties)) {
            $electionHasCandidate->setElection($properties['elections_id']);
        }
    }
}

?>
