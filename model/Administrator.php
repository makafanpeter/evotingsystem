<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Adminsitrator
 *
 * @author Peter
 */
class Administrator extends Person {
    //put your code here

    const SUPER_ADMIN = 'super';
    const OTHER_ADMIN = 'other';

    private $role;

    public function __construct() {
        parent::__construct();
        $this->setRole(self::OTHER_ADMIN);
    }

    public function getRole() {
        return $this->role;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    public static function getAllRoles() {
        return array(self::SUPER_ADMIN, self::OTHER_ADMIN);
    }

}

?>
