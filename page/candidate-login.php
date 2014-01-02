<?php

$errors = array();
if (array_key_exists('login', $_POST)) {
    $data = array('matricNumber' => $_POST['data']['matricNumber'], 'password' => $_POST['data']['password']);
    $errors = LoginValidation::validate($data);
    $candidateDao = new CandidateDao();
    $candidate = (empty($errors)) ? $candidateDao->findByMatricNumber(Utils::mysqlPrep($_POST['data']['matricNumber'])) : new Candidate();
    if ($candidate->getId() && ($candidate->getPassword() == sha1($_POST['data']['password']))) {
        SessionManager::setSession('candidateId', $candidate->getId());
        SessionManager::setSession('candidate', serialize($candidate));
        SessionManager::setSession('matricNumber', $candidate->getMatricNumber());
        Utils::redirect('candidate-home');
    } elseif (empty($errors)) {
        $errors[] = new Error('matricNumber', 'Invalid matric mumber or password combination.');
    }
}


if (array_key_exists('logout', $_GET)) {
    Utils::candidateLoggOut();
    Flash::addFlash('You are logged Out');
} elseif (Utils::candidateLoggedIn()) {
    Utils::redirect('candidate-home');
}
?>
