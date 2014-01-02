<?php
Utils::confirmAdminLogIn();
$currentAdmin = unserialize(SessionManager::getSession('admin'));
$admin = unserialize(SessionManager::getSession('admin'));
Utils::generateResult($admin->getUniversity(), $admin->getFaculty(), $admin->getDepartment());
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
