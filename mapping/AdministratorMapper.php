<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdministratorMapper
 *
 * @author Peter
 */
class AdministratorMapper {
    //put your code here
    public function __construct() {
        
    }

    public static function map(Administrator $admin, array $properties) {
        if (array_key_exists('id', $properties)) {
            $admin->setId($properties['id']);
        }
        if (array_key_exists('matricNumber', $properties)) {
            $admin->setMatricNumber($properties['matricNumber']);
        }
        if (array_key_exists('firstname', $properties)) {
            $admin->setFirstName($properties['firstname']);
        }
        if (array_key_exists('lastname', $properties)) {
            $admin->setLastName($properties['lastname']);
        }
        if (array_key_exists('othernames', $properties)) {
            $admin->setOtherNames($properties['othernames']);
        }
        
        if (array_key_exists('password', $properties)) {
            $admin->setPassword($properties['password']);
        }
        if (array_key_exists('last_modified_on', $properties)) {
            $lastModifiedOn = self::createDateTime($properties['last_modified_on']);
            if ($lastModifiedOn) {
                $admin->setLastModifiedOn($lastModifiedOn);
            }
        }
        if (array_key_exists('created_on', $properties)) {
            $createdOn = self::createDateTime($properties['created_on']);
            if ($createdOn) {
                $admin->setCreatedOn($createdOn);
            }
        }
        if (array_key_exists('department_id', $properties)) {
            $admin->setDepartment($properties['department_id']);
        }
        if (array_key_exists('University_id', $properties)) {
            $admin->setUniversity($properties['University_id']);
        }
        if (array_key_exists('Faculty_id', $properties)) {
            $admin->setFaculty($properties['Faculty_id']);
        }
        if (array_key_exists('role', $properties)) {
            $admin->setRole($properties['role']);
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
