<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FacultyMapper
 *
 * @author Peter
 */
class FacultyMapper {
    //put your code here

    /**
     * 
     */
    public function __construct() {
        
    }

    /**
     * 
     * @param Faculty $faculty
     * @param array $properties
     */
    public static function map(Faculty $faculty, array $properties) {

        if (array_key_exists('id', $properties)) {
            $faculty->setId($properties['id']);
        }
        if (array_key_exists('name', $properties)) {
            $faculty->setName($properties['name']);
        }
        if (array_key_exists('University_id', $properties)) {
            $faculty->setUniversityId($properties['University_id']);
        }
    }

}

?>
