<?
Utils::confirmCandidateLogIn();
$candidate = unserialize(SessionManager::getSession('candidate'));
Utils::generateResult($candidate->getUniversity(), $candidate->getFaculty(), $candidate->getDepartment());
    
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>