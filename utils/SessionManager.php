<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SessionManager
 * Manage Sessions
 * @author Peter
 */
class SessionManager {
    //put your code here
    /**
     * @param type $name
     * @param type $variable
     */
    public static function setSession($name,$variable){
        $_SESSION[$name] = $variable;
    }
    
    /**
     * 
     * @param type $name
     */
     public static function getSession($name){
        return $_SESSION[$name];
    }
}

?>
