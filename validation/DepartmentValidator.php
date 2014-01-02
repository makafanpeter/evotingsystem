<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DepartmentValidator
 *
 * @author Peter
 */
class DepartmentValidator extends Validation implements Validator {
    //put your code here
    public function __construct() {
        
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
        if (!is_numeric($data['Faculty_id'])) {
            $errors[] = new Error('faculty', 'Invalid faculty selected.');
        }
        return $errors;
    }
}

?>
