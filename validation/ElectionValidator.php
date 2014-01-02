<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ElectionValidator
 *
 * @author Peter
 */
class ElectionValidator implements Validator {

    //put your code here

    function __construct() {
        
    }

    /**
     * 
     * @param array $data
     */
    public static function validate(array $data) {
        $errors = array();
        if (empty($data['name'])) {
            $errors[] = new Error('name', 'Empty Name Field.');
        }
        if($data['endtime'] < $data['starttime'] || $data['starttime'] > $data['endtime']) {
            $errors[] = new Error('starttime', 'Start time can be more than End time.');
            $errors[] = new Error('endtime', 'End time can be more than Start time.');
        }
        return $errors;
    }

}

?>
