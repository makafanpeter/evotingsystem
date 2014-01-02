<?php
Utils::confirmAdminLogIn();
$universitydao = new UniversityDao();
$universities = $universitydao->find();
$thispage = 'admin-list-university';
SessionManager::setSession('previouspage',$thispage );
$currentAdmin = unserialize(SessionManager::getSession('admin'));
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
