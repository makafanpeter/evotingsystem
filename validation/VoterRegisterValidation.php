<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VoterRegisterValidation
 *
 * @author Peter
 */
class VoterRegisterValidation extends Validation implements Validator{

    //put your code here
    public function __construct() {
        
    }

    /**
     * 
     * @param array $data
     */
    public static function validate(array $data) {
        
        $errors = array();
       
        if (empty($data['firstname'])) {
            $errors[] = new Error('firstname', 'Empty firstname field.');
        } elseif (!parent::validateUsername($data['firstname'])) {
            $errors[] = new Error('firstname', 'Invalid firstname.');
        }
        if (empty($data['lastname'])) {
            $errors[] = new Error('lastname', 'Empty Lastname field.');
        } elseif (!parent::validateUsername($data['lastname'])) {
            $errors[] = new Error('lastname', 'Invalid Lastname.');
        }
        if (empty($data['matricNumber'])) {
            $errors[] = new Error('matricNumber', 'Empty matric number field.');
        } elseif (!parent::isvalidMatricNubmer($data['matricNumber'])) {
            $errors[] = new Error('matricNumber', 'Invalid matric number.');
        }
        if (empty($data['password1'])) {
            $errors[] = new Error('password1', 'Empty password field.');
        }
        if (empty($data['password2'])) {
            $errors[] = new Error('password2', 'Empty password field.');
        }

        if ($data['password1'] !== $data['password2']) {
            $errors[] = new Error('password1', 'Password mismatch.');
            $errors[] = new Error('password2', 'Password mismatch.');
        }
         if (!is_numeric($data['election_id'])) {
            $errors[] = new Error('election', 'Invalid election selected.');
        }
        if (!is_numeric($data['University_id'])) {
            $errors[] = new Error('university', 'Invalid university selected.');
        }
        if (!is_numeric($data['Faculty_id'])) {
            $errors[] = new Error('faculty', 'Invalid faculty selected.');
        }
        if (!is_numeric($data['department_id'])) {
            $errors[] = new Error('department', 'Invalid department selected.');
        }
        return $errors;
    }
   
}

?>
