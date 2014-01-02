<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CandidateMapper
 *
 * @author Peter
 */
class CandidateMapper {

    //put your code here
    public function __construct() {
        
    }

    public static function map(Candidate $candidate, array $properties) {
        if (array_key_exists('id', $properties)) {
            $candidate->setId($properties['id']);
        }
        if (array_key_exists('matricNumber', $properties)) {
            $candidate->setMatricNumber($properties['matricNumber']);
        }
        if (array_key_exists('firstname', $properties)) {
            $candidate->setFirstName($properties['firstname']);
        }
        if (array_key_exists('lastname', $properties)) {
            $candidate->setLastName($properties['lastname']);
        }
        if (array_key_exists('othernames', $properties)) {
            $candidate->setOtherNames($properties['othernames']);
        }
        /*
        if (array_key_exists('dateOfBirth', $properties)) {
            $dob = self::createDate($properties['dateOfBirth']);
            if ($dob) {
                $candidate->setDateOfBirth($dob);
            }
        }
        if (array_key_exists('gender', $properties)) {
            $candidate->setGender($properties['gender']);
        }
        if (array_key_exists('email', $properties)) {
            $candidate->setEmail($properties['email']);
        }
         * 
         */
        if (array_key_exists('password', $properties)) {
            $candidate->setPassword($properties['password']);
        }
        if (array_key_exists('isvoted', $properties)) {
            $candidate->setVoted($properties['isvoted']);
        }
        if (array_key_exists('position_id', $properties)) {
            $candidate->setPositionId($properties['position_id']);
        }
        if (array_key_exists('last_modified_on', $properties)) {
            $lastModifiedOn = self::createDateTime($properties['last_modified_on']);
            if ($lastModifiedOn) {
                $candidate->setLastModifiedOn($lastModifiedOn);
            }
        }
        if (array_key_exists('created_on', $properties)) {
            $createdOn = self::createDateTime($properties['created_on']);
            if ($createdOn) {
                $candidate->setCreatedOn($createdOn);
            }
        }
        if (array_key_exists('department_id', $properties)) {
            $candidate->setDepartment($properties['department_id']);
        }
        if (array_key_exists('University_id', $properties)) {
            $candidate->setUniversity($properties['University_id']);
        }
        if (array_key_exists('Faculty_id', $properties)) {
            $candidate->setFaculty($properties['Faculty_id']);
        }
    }

    private static function createDateTime($input) {
        $date = DateTime::createFromFormat('Y-n-j H:i:s', $input);
        return $date;
    }

    private static function createDate($input) {
        $date = DateTime::createFromFormat('Y-n-j', $input);
        return $date;
    }

}

?>
