<?php
Utils::confirmVoteLogIn();
$ballotbox = unserialize(SessionManager::getSession('ballotbox'));
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 */
if (array_key_exists('remove', $_GET)) {
    $candidateId = Utils::postURLParam('candidateId');
    if (!empty($candidateId)) {
        $candidatedao = new CandidateDao();
        $candidate = $candidatedao->findById($candidateId);
        $ballotbox->removeItem($candidate);
        SessionManager::setSession('ballotbox', serialize($ballotbox));
    }
}elseif (array_key_exists('clear', $_GET)) {
    $ballotbox->clear();
    SessionManager::setSession('ballotbox', serialize($ballotbox));
}
?>
