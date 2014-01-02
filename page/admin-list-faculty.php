<?php
Utils::confirmAdminLogIn();
$faculty = new Faculty();
$facultydao = new FacultyDao();
$faculties = $facultydao->find();
$universitydao = new UniversityDao();
$thispage = 'admin-list-faculty';
SessionManager::setSession('previouspage',$thispage );
$currentAdmin = unserialize(SessionManager::getSession('admin'));

        
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
