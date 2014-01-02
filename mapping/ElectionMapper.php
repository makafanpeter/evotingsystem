<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ElectionMapper
 *
 * @author Peter
 */
class ElectionMapper {
    //put your code here
    public function __construct() {
        
    }

    public static function map(Election $election, array $properties) {
        if (array_key_exists('id', $properties)) {
            $election->setId($properties['id']);
        }
        if (array_key_exists('name', $properties)) {
            $election->setName($properties['name']);
        }
        if (array_key_exists('starttime', $properties)) {
            $starttime = self::createDateTime($properties['starttime']);
            if ($starttime) {
                $election->setStartTime($starttime);
            }
        }
        if (array_key_exists('endtime', $properties)) {
            $endtime = self::createDateTime($properties['endtime']);
            if ($endtime) {
                $election->setEndTime($endtime);
            }
        }
        
    }

    private static function createDateTime($input) {
        $date = DateTime::createFromFormat('Y-n-j H:i:s', $input);
        return $date;
    }

}

?>
