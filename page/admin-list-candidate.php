<?php
Utils::confirmAdminLogIn();
$candidateDao = new CandidateDao();
$candidates = $candidateDao->findAll();
$facultydao = new FacultyDao();
$universitydao = new UniversityDao();
$departmentdao = new DepartmentDao();
$positiondao = new PositionDao();
$currentAdmin = unserialize(SessionManager::getSession('admin'));
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
