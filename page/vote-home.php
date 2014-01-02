<?php
Utils::confirmVoteLogIn();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$positiondao = new PositionDao();
$positions = $positiondao->find();
?>