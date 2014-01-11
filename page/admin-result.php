<?php
Utils::confirmAdminLogIn();
$currentAdmin = unserialize(SessionManager::getSession('admin'));
if (!($currentAdmin->getRole() === 'super')) {
    throw new UnauthorizedException('You are not authorized to perform this operation.');
}
$positionDao = new PositionDao();
$positions = $positionDao->find();
$resultDao = new ResultDao();

?>
