<?php
Utils::confirmAdminLogIn();
$department = new Department();
$departmentdao = new DepartmentDao();
$departments = $departmentdao->find();
$facultydao = new FacultyDao();
$thispage = 'admin-list-department';
SessionManager::setSession('previouspage',$thispage );
$currentAdmin = unserialize(SessionManager::getSession('admin'));
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
