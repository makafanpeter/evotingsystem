<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PositionMapper
 *
 * @author Peter
 */
class PositionMapper {
    //put your code here
    //put your code here
    /**
     * Constructor
     */
    public function __construct() {
        
    }

    /**
     * 
     * @param Position $position
     * @param array $properties
     */
    public static function map(Position $position, array $properties) {
        if (array_key_exists('id', $properties)) {
            $position->setId($properties['id']);
        }
        if (array_key_exists('name', $properties)) {
            $position->setName($properties['name']);
        }
        if (array_key_exists('level', $properties)) {
            $position->setPostionLevel($properties['level']);
        }
    }
}

?>
