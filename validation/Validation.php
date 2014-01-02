<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Validation
 *
 * @author Peter
 */
abstract class Validation {
    //put your code here
    
    public function __construct() {
        
    }


    public static function validateMatricNubmer($matric) {
        if (!self::validateMatricNubmer($matric)) {
            return false;
        }
        return true;
    }

    protected static function validateEmailAddr($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * 
     * @param type $matric
     * @return type
     */
    protected static function isvalidMatricNubmer($matric) {
        return preg_match('/[0-9]{2}[\/{\|}~]{1}[0-9]{2}[a-zA-Z]{2}[0-9]{3}$/', $matric);
    }

    protected static function validateUsername($username) {
        return preg_match('/^[A-Z0-9]{2,20}$/i', $username);
    }

}

?>
