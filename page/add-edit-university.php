<?php
Utils::confirmAdminLogIn();
$currentAdmin = unserialize(SessionManager::getSession('admin'));
if (!($currentAdmin->getRole() === 'super')) {
    throw new UnauthorizedException('You are not authorized to perform this operation.');
}
$errors = array();
$university = null;
$edit = array_key_exists('id', $_GET);
if ($edit) {
    $university = Utils::getUniversityByGetId();
} else {
    $university = new University();
}
if (array_key_exists('cancel', $_POST)) {
    // redirect
    Utils::redirect('admin-list-university');
} elseif (array_key_exists('save', $_POST)) {
    // for security reasons, do not map the whole $_POST['todo']
    $data = array(
        'name' => Utils::escape($_POST['data']['name']),
         );
    // map
    UniversityMapper::map($university, $data);
    // validate
    $errors = UniversityValidator::validate($data);
    // validate
    if (empty($errors)) {
        // save
        $dao = new UniversityDao();
        $university = $dao->save($university);
        Flash::addFlash('University saved successfully.');
        // redirect
        Utils::redirect('admin-list-university');
    }
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
