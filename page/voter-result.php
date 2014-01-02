<?php

Utils::confirmVoterLogIn();
$voter = unserialize(SessionManager::getSession('Voter'));
Utils::generateResult($voter->getUniversity(), $voter->getFaculty(), $voter->getDepartment());

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
