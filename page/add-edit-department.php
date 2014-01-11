<?php
Utils::confirmAdminLogIn();
$currentAdmin = unserialize(SessionManager::getSession('admin'));
if (!($currentAdmin->getRole() === 'super')) {
    throw new UnauthorizedException('You are not authorized to perform this operation.');
}
$facultydao = new FacultyDao();
$faculties = $facultydao->find();
$errors = array();
$department = null;
$edit = array_key_exists('id', $_GET);
if ($edit) {
    $department = Utils::getDepartmentByGetId();
} else {
    $department = new Department();
}
if (array_key_exists('cancel', $_POST)) {
    // redirect
    Utils::redirect('admin-list-department');
} elseif (array_key_exists('save', $_POST)) {
    // for security reasons, do not map the whole $_POST['todo']
    $data = array(
        'name' => htmlspecialchars($_POST['data']['name']),
        'Faculty_id' =>$_POST['data']['faculty']
         );
    // map
    DepartmentMapper::map($department, $data);
    // validate
    $errors = DepartmentValidator::validate($data);
    // validate
    if (empty($errors)) {
        // save
        $dao = new DepartmentDao();
        $department = $dao->save($department);
        Flash::addFlash('Department saved successfully.');
        // redirect
        Utils::redirect('admin-list-department');
    }
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
