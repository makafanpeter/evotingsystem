<?php

$errors = array();


if (array_key_exists('login', $_POST)) {
    $data = array('matricNumber' => $_POST['data']['matricNumber'], 'password' => $_POST['data']['password']);
    $errors = LoginValidation::validate($data);
    $voterDao = new VoterDao();
    $voter = (empty($errors)) ? $voterDao->findByMatricNumber($_POST['data']['matricNumber']) : new Voter();
    if ($voter->getId() && ($voter->getPassword() == $_POST['data']['password'])) {
        SessionManager::setSession('voterId', $voter->getId());
        SessionManager::setSession('Voter', serialize($voter));
        SessionManager::setSession('matricNumber', $voter->getMatricNumber());
        Utils::redirect('voter-home');
    } elseif (empty($errors)) {
        $errors[] = new Error('matricNumber', 'Wrong matric mumber or password combination.');
    }
}


if (array_key_exists('logout', $_GET)) {
    Utils::voterLoggOut();
    Flash::addFlash('You are logged Out');
} elseif (Utils::voterLoggedIn()) {
    Utils::redirect('voter-home');
}


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
