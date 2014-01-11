<?php

$errors = array();
Utils::voteLoggOut();
if (array_key_exists('login', $_POST)) {
    $data = array('matricNumber' => $_POST['data']['matricNumber'], 'password' => $_POST['data']['password']);
    $errors = LoginValidation::validate($data);
    $voter = new Voter();
    $election = new Election();
    if (empty($errors)) {
        $voterDao = new VoterDao();
        $voter = $voterDao->findByMatricNumber(Utils::mysqlPrep($_POST['data']['matricNumber']));
        if ($voter->getId()) {
            $electionHasVoterdao = new ElectionHasVoterDao();
            $electiondao = new ElectionDao();
            $electionHasVoter = $electionHasVoterdao->findById($voter->getId());
            $election = $electiondao->findById($electionHasVoter->getElection());
        }
        if ($voter->getId() === NULL) {
            $candidateDao = new CandidateDao();
            $voter = $candidateDao->findByMatricNumber($_POST['data']['matricNumber']);
            if ($voter->getId()) {
            $electionHasCandidatedao = new ElectionHasCandidateDao();
            $electiondao = new ElectionDao();
            $electionHasCandidate = $electionHasCandidatedao->findById($voter->getId());
            $election = $electiondao->findById($electionHasCandidate->getElection());
        }
        }
    }

    if ($voter->getId() && ($voter->getPassword() == $_POST['data']['password'])) {
        if ($voter->getVoted() == false) {
            SessionManager::setSession('voteId', $voter->getId());
            SessionManager::setSession('voter', serialize($voter));
            SessionManager::setSession('matricNumber', $voter->getMatricNumber());
            SessionManager::setSession('election', serialize($election));
            $ballotbox = new BallotBox();
            SessionManager::setSession('ballotbox', serialize($ballotbox));
            Utils::redirect('vote-home');
        } else {
            $errors[] = new Error('Voterhasvoted', 'You have already voted.');
        }
    } elseif (empty($errors)) {
        $errors[] = new Error('matricNumber', 'Invalid matric mumber or password combination.');
    }
}
if (array_key_exists('logout', $_GET)) {
    Flash::addFlash('You are logged Out');
} elseif (Utils::voteLoggedIn()) {
    Utils::redirect('vote-home');
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
