<?php
Utils::confirmAdminLogIn();
$currentAdmin = unserialize(SessionManager::getSession('admin'));
if (!($currentAdmin->getRole() === 'super')) {
    throw new UnauthorizedException('You are not authorized to perform this operation.');
}
$errors = array();
$election = null;
$edit = array_key_exists('id', $_GET);
if ($edit) {
    $election = Utils::getElectionByGetId();
} else {
    $election = new Election();
    $endtime = new DateTime("+1 day");
    $endtime->setTime(0, 0, 0);
    $election->setEndTime($endtime);
}
if (array_key_exists('cancel', $_POST)) {
    // redirect
    Utils::redirect('admin-list-election');
} elseif (array_key_exists('save', $_POST)) {
    // for security reasons, do not map the whole $_POST['todo']
    $data = array(
        'name' => htmlspecialchars($_POST['data']['name']),
        'starttime' =>$_POST['data']['starttime'],
        'endtime' =>$_POST['data']['endtime']
         );
    // map
    ElectionMapper::map($election, $data);
    // validate
    $errors = ElectionValidator::validate($data);
    // validate
    if (empty($errors)) {
        // save
        $dao = new ElectionDao();
        $election = $dao->save($election);
        Flash::addFlash('Election saved successfully.');
        // redirect
        Utils::redirect('admin-list-election');
    }
}
?>
