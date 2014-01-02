<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DepartmentMapper
 *
 * @author Peter
 */
class DepartmentMapper {
    //put your code here
    public function __construct() {
        
    }
    
    public static function  map(Department $department,array $properties){
        if (array_key_exists('id', $properties)) {
            $department->setId($properties['id']);
        }
        if (array_key_exists('name', $properties)) {
            $department->setName($properties['name']);
        }
        if (array_key_exists('Faculty_id', $properties)) {
            $department->setFacultyId($properties['Faculty_id']);
        }
        
    }
}

?>
