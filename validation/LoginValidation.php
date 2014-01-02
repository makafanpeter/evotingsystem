<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoginValidation
 *
 * @author Peter
 */
class LoginValidation extends Validation implements Validator {

    //put your code here
    public function __construct() {
        
    }

    /**
     * 
     * @param array $data
     */
    public static function validate(array $data) {
        $errors = array();
        if (empty($data['matricNumber'])) {
            $errors[] = new Error('matricNumber', 'Empty Matric Number Field.');
        }elseif (!parent::isvalidMatricNubmer($data['matricNumber'])) {
            $errors[] = new Error('matricNumber', 'Invalid Matric Number.');
        }
        if (empty($data['password'])) {
            $errors[] = new Error('password', 'Empty Password Field.');
        }  
        return $errors;
    }

}

?>
