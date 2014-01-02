<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ElectionHasVoterMapper
 *
 * @author Peter
 */
class ElectionHasVoterMapper {

    //put your code here
    public function __construct() {
        
    }

    public static function map(ElectionHasVoter $electionHasVoter, array $properties) {
        if (array_key_exists('voters_id', $properties)) {
            $electionHasVoter->setVoter($properties['voters_id']);
        }
        if (array_key_exists('elections_id', $properties)) {
            $electionHasVoter->setElection($properties['elections_id']);
        }
    }

}

?>
