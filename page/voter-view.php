<?php
Utils::confirmVoterLogIn();
$voterDao = new VoterDao();
$voter = $voterDao->findById(SessionManager::getSession('voterId'));
$universitydao = new UniversityDao();
$university  = $universitydao->findById($voter->getUniversity());
$facultydao = new FacultyDao();
$faculty  = $facultydao->findById($voter->getFaculty());
$departmentdao = new DepartmentDao();
$department  = $departmentdao->findById($voter->getDepartment());

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
