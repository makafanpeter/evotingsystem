<?php
Utils::confirmAdminLogIn();
$currentAdmin = unserialize(SessionManager::getSession('admin'));
if (!($currentAdmin->getRole() === 'super')) {
    throw new UnauthorizedException('You are not authorized to perform this operation.');
}
$universitydao = new UniversityDao();
$universities = $universitydao->find();
$errors = array();
$faculty = null;
$edit = array_key_exists('id', $_GET);
if ($edit) {
    $faculty = Utils::getFacultyByGetId();
} else {
    $faculty = new Faculty();
}
if (array_key_exists('cancel', $_POST)) {
    // redirect
    Utils::redirect('admin-list-faculty');
} elseif (array_key_exists('save', $_POST)) {
    // for security reasons, do not map the whole $_POST['todo']
    $data = array(
        'name' => Utils::escape($_POST['data']['name']),
        'University_id' =>$_POST['data']['university']
         );
    // map
    FacultyMapper::map($faculty, $data);
    // validate
    $errors = FacultyValidator::validate($data);
    // validate
    if (empty($errors)) {
        // save
        $dao = new FacultyDao();
        $faculty = $dao->save($faculty);
        Flash::addFlash('Faculty saved successfully.');
        // redirect
        Utils::redirect('admin-list-faculty');
    }
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
