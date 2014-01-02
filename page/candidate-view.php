<?php
Utils::confirmCandidateLogIn();
$candidatedoa = new CandidateDao();
$candidate = $candidatedoa->findById(SessionManager::getSession('candidateId'));
$universitydao = new UniversityDao();
$university  = $universitydao->findById($candidate->getUniversity());
$facultydao = new FacultyDao();
$faculty  = $facultydao->findById($candidate->getFaculty());
$departmentdao = new DepartmentDao();
$department  = $departmentdao->findById($candidate->getDepartment());
$positiondao = new PositionDao();
$position  = $positiondao->findbyId($candidate->getPosition());
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
