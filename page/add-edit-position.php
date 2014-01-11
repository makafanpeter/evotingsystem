<?php
Utils::confirmAdminLogIn();
$currentAdmin = unserialize(SessionManager::getSession('admin'));
if (!($currentAdmin->getRole() === 'super')) {
    throw new UnauthorizedException('You are not authorized to perform this operation.');
}
$levels = Position::allPositionLevel();
$errors = array();
$position = null;
$edit = array_key_exists('id', $_GET);
if ($edit) {
    $position = Utils::getPositionByGetId();
} else {
    $position = new Position();
}
if (array_key_exists('cancel', $_POST)) {
    // redirect
    Utils::redirect('admin-list-position');
} elseif (array_key_exists('save', $_POST)) {
    // for security reasons, do not map the whole $_POST['todo']
    $data = array(
        'name' => htmlspecialchars($_POST['data']['name']),
        'level' =>$_POST['data']['level']
         );
    // map
    PositionMapper::map($position, $data);
    // validate
    $errors = PositionValidator::validate($data);
    // validate
    if (empty($errors)) {
        // save
        $dao = new PositionDao();
        $position = $dao->save($position);
        Flash::addFlash('Position saved successfully.');
        // redirect
        Utils::redirect('admin-list-position');
    }
}
?>
