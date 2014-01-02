<?php 
Utils::confirmAdminLogIn();
Utils::confirmAdminLogIn();
$adminDao = new AdministratorDao();
$admins = $adminDao->find();
$facultydao = new FacultyDao();
$universitydao = new UniversityDao();
$departmentdao = new DepartmentDao();
$currentAdmin = unserialize(SessionManager::getSession('admin'));
?>