<?php
Utils::confirmAdminLogIn();
$adminDao = new AdministratorDao();
$admin = $adminDao->findById(SessionManager::getSession('adminId'));
$universitydao = new UniversityDao();
$university  = $universitydao->findById($admin->getUniversity());
$facultydao = new FacultyDao();
$faculty  = $facultydao->findById($admin->getFaculty());
$departmentdao = new DepartmentDao();
$department  = $departmentdao->findById($admin->getDepartment());
$currentAdmin = unserialize(SessionManager::getSession('admin'));
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
