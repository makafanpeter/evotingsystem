<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ResultMapper
 *
 * @author Peter
 */
class ResultMapper {

    //put your code here
    //put your code here
    public function __construct() {
        
    }

    public static function map(Result $result, array $properties) {
        if (array_key_exists('id', $properties)) {
            $result->setId($properties['id']);
        }
        if (array_key_exists('candidate_id', $properties)) {
            $result->setCandidate($properties['candidate_id']);
        }
        if (array_key_exists('position_id', $properties)) {
            $result->setPosition($properties['position_id']);
        }
        if (array_key_exists('date_created', $properties)) {
            $createdOn = self::createDateTime($properties['date_created']);
            if ($createdOn) {
                $result->setCreatedOn($properties['date_created']);
            }
        }
        if (array_key_exists('name', $properties)) {
            $result->setCandidate($properties['name']);
        }
        if (array_key_exists('votecount', $properties)) {
            $result->setCount($properties['votecount']);
        }
    }

    private static function createDateTime($input) {
        $date = DateTime::createFromFormat('Y-n-j H:i:s', $input);
        return $date;
    }

}

?>
