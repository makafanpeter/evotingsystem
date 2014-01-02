<?php

$errors = array();


if (array_key_exists('login', $_POST)) {
    $data = array('matricNumber' => $_POST['data']['matricNumber'], 'password' => $_POST['data']['password']);
    $errors = LoginValidation::validate($data);
    $adminDao = new AdministratorDao();
    $admin = (empty($errors)) ? $adminDao->findByMatricNumber($_POST['data']['matricNumber']) : new Administrator();
    if ($admin->getId() && ($admin->getPassword() == sha1($_POST['data']['password']))) {
        SessionManager::setSession('adminId', $admin->getId());
        SessionManager::setSession('admin', serialize($admin));
        SessionManager::setSession('matricNumber', $admin->getMatricNumber());
        Utils::redirect('admin-home');
    } elseif (empty($errors)) {
        $errors[] = new Error('matricNumber', 'Wrong matric number or password combination.');
    }
}


if (array_key_exists('logout', $_GET)) {
    Utils::adminLoggOut();
    Flash::addFlash('You are logged Out');
} elseif (Utils::adminLoggedIn()) {
    Utils::redirect('admin-home');
}


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>