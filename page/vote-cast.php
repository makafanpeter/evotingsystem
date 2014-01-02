<?php

Utils::confirmVoteLogIn();
$positiondao = new PositionDao();
$positions = $positiondao->find();
$ballotbox = unserialize(SessionManager::getSession('ballotbox'));
$voter =  unserialize(SessionManager::getSession('voter'));
$election     =  unserialize(SessionManager::getSession('election'));
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 */

if (array_key_exists('vote', $_POST)) {
    if($voter instanceof Voter){
        $voterdao = new VoterDao();
        $voter  = $voterdao->findById($voter->getId());
        $voter->setVoted(TRUE);
        $voterdao->save($voter);
    }  else {
        $candidatedao = new CandidateDao();
        $voter  = $candidatedao->findById($voter->getId());
        $voter->setVoted(TRUE);
        $candidatedao->save($voter);
    }
    VoteManager::vote($ballotbox);
    $ballotbox->clear();
    SessionManager::setSession('ballotbox', serialize($ballotbox));
    Utils::voteLoggOut();
    Utils::redirect('vote-confirmation');
}
?>
