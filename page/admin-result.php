<?php
Utils::confirmAdminLogIn();
$positionDao = new PositionDao();
$positions = $positionDao->find();
$resultDao = new ResultDao();
$currentAdmin = unserialize(SessionManager::getSession('admin'));
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
