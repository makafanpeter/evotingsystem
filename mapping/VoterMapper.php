<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VoterMapper
 *
 * @author Peter
 */
class VoterMapper {

    //put your code here
    public function __construct() {
        
    }

    public static function map(Voter $voter, array $properties) {
        if (array_key_exists('id', $properties)) {
            $voter->setId($properties['id']);
        }
        if (array_key_exists('matricNumber', $properties)) {
            $voter->setMatricNumber($properties['matricNumber']);
        }
        if (array_key_exists('firstname', $properties)) {
            $voter->setFirstName($properties['firstname']);
        }
        if (array_key_exists('lastname', $properties)) {
            $voter->setLastName($properties['lastname']);
        }
        if (array_key_exists('othernames', $properties)) {
            $voter->setOtherNames($properties['othernames']);
        }
        /*
        if (array_key_exists('dateOfBirth', $properties)) {
            $dob = self::createDate($properties['dateOfBirth']);
            if ($dob) {
                $voter->setDateOfBirth($dob);
            }
        }
        if (array_key_exists('gender', $properties)) {
            $voter->setGender($properties['gender']);
        }
        if (array_key_exists('email', $properties)) {
            $voter->setEmail($properties['email']);
        }
         * 
         */
        if (array_key_exists('password', $properties)) {
            $voter->setPassword($properties['password']);
        }
        if (array_key_exists('isvoted', $properties)) {
            $voter->setVoted($properties['isvoted']);
        }
        if (array_key_exists('last_modified_on', $properties)) {
            $lastModifiedOn = self::createDateTime($properties['last_modified_on']);
            if ($lastModifiedOn) {
                $voter->setLastModifiedOn($lastModifiedOn);
            }
        }
        if (array_key_exists('created_on', $properties)) {
            $createdOn = self::createDateTime($properties['created_on']);
            if ($createdOn) {
                $voter->setCreatedOn($createdOn);
            }
        }
        if (array_key_exists('department_id', $properties)) {
            $voter->setDepartment($properties['department_id']);
        }
        if (array_key_exists('University_id', $properties)) {
            $voter->setUniversity($properties['University_id']);
        }
        if (array_key_exists('Faculty_id', $properties)) {
            $voter->setFaculty($properties['Faculty_id']);
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
