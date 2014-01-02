<?php
Utils::confirmAdminLogIn();
$electiondao = new ElectionDao();
$elections = $electiondao->find();
$thispage = 'admin-list-election';
SessionManager::setSession('previouspage',$thispage );
$currentAdmin = unserialize(SessionManager::getSession('admin'));
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
