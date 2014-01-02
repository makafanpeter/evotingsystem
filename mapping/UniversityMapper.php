<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UniversityMapper
 *
 * @author Peter
 */
class UniversityMapper {

    //put your code here
    /**
     * Constructor
     */
    public function __construct() {
        
    }

    /**
     * 
     * @param University $university
     * @param array $properties
     */
    public static function map(University $university, array $properties) {
        if (array_key_exists('id', $properties)) {
            $university->setId($properties['id']);
        }
        if (array_key_exists('name', $properties)) {
            $university->setName($properties['name']);
        }
    }

}

?>
