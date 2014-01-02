<?php
Utils::confirmVoteLogIn();

$ballotbox = unserialize(SessionManager::getSession('ballotbox'));
$voter     =  unserialize(SessionManager::getSession('voter'));
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$positionId = Utils::getUrlParam('id');

if ($positionId != null) {

    $candidatedao = new CandidateDao();
    $positiondao = new PositionDao();
    $positions = $positiondao->find();
    $selectedPosition = $positiondao->findById($positionId);
    $positionCandidate = $candidatedao->find($selectedPosition,$voter->getUniversity(),$voter->getFaculty(),$voter->getDepartment());
}

if (array_key_exists('addtobox', $_GET)) {

//    if ($ballotbox == NULL) {
//        $ballotbox = new BallotBox();
//        SessionManager::setSession('ballotbox', serialize($ballotbox));
//    }

    $candidateId = Utils::postURLParam('candidateId');
    if (!empty($candidateId)) {
        $candidatedao = new CandidateDao();
        $candidate = $candidatedao->findById($candidateId);
        $ballotbox->addItem($candidate);
        SessionManager::setSession('ballotbox', serialize($ballotbox));
    }
}
?>
