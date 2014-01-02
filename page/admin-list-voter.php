<?php
Utils::confirmAdminLogIn();
$voterDao = new VoterDao();
$voters = $voterDao->find();
$facultydao = new FacultyDao();
$universitydao = new UniversityDao();
$departmentdao = new DepartmentDao();
$currentAdmin = unserialize(SessionManager::getSession('admin'));
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
