<?php
Utils::confirmAdminLogIn();
$positiondao = new PositionDao();
$positions = $positiondao->find();
$thispage = 'admin-list-position';
SessionManager::setSession('previouspage',$thispage );
$currentAdmin = unserialize(SessionManager::getSession('admin'));
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
