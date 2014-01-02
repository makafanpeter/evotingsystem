<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Validate
 *
 * @author Peter
 */
class Validate extends Validation implements Validator {

    public function __construct() {
        
    }

    //put your code here
    public static function validate(array $data) {
        $errors = array();
        if (empty($data['firstname'])) {
            $errors[] = new Error('firstname', 'Empty firstname Field.');
        } elseif (!parent::validateUsername($data['firstname'])) {
            $errors[] = new Error('firstname', 'Invalid firstname.');
        }
        if (empty($data['lastname'])) {
            $errors[] = new Error('lastname', 'Empty Lastname Field.');
        } elseif (!parent::validateUsername($data['lastname'])) {
            $errors[] = new Error('lastname', 'Invalid lastname.');
        }

        if (($data['password1'] !== $data['password2'])) {
            $errors[] = new Error('password1', 'Password mismatch.');
            $errors[] = new Error('password2', 'Password mismatch.');
        }
        return $errors;
    }


}

?>
