<?php
Utils::confirmAdminLogIn();
$universitydao = new UniversityDao();
$universities = $universitydao->find();
$errors = array();
$currentAdmin = unserialize(SessionManager::getSession('admin'));

if (!($currentAdmin->getRole() === 'super')) {
    throw new UnauthorizedException('You are not authorized to perform this operation.');
}
if (array_key_exists('cancel', $_POST)) {
    Utils::redirect('admin-list-administrator');
} elseif (array_key_exists('register', $_POST)) {
    $data = array(
        'firstname' => $_POST['data']['firstname']
        , 'lastname' => $_POST['data']['lastname']
        , 'othernames' => htmlspecialchars($_POST['data']['othernames'])
        , 'matricNumber' => $_POST['data']['matricNumber']
        , 'role' => $_POST['data']['role']
        , 'University_id' => $_POST['data']['university']
        , 'Faculty_id' => $_POST['data']['faculty']
        , 'department_id' => $_POST['data']['department']
        , 'password1' => $_POST['data']['password1']
        , 'password2' => $_POST['data']['password2']
    );
    $errors = AdminValidator::validate($data);
    $picData = array('avatar' => $_FILES['avatar']);
    if ($_FILES['avatar']['name'] == '') {
        $errors[] = new Error('picture', 'picture required.');
    } else {
        $picsError = PictureValidate::validate($picData);
        $errors = array_merge($errors, $picsError);
    }
    if (empty($errors)) {
        $administrator = new Administrator();
        $administratordao = new AdministratorDao();
        $administrator = $administratordao->findByMatricNumber($data['matricNumber']);
        if ($administrator->getId()) {
            $errors[] = new Error('matricNumber', 'matric number already registered.');
        } else {
            $password1 = $data['password1'];
            $password = sha1($password1);
            $administrator->setPassword($password);
            AdministratorMapper::map($administrator, $data);
            $administrator = $administratordao->save($administrator);
            header('Content-Type: image/jpeg');
            $pic = new JpegThumbnail(130, 155);
            $pic->generate($_FILES['avatar']['tmp_name'], '../avatar/' . str_replace('/', '', $administrator->getMatricNumber()) . '.jpg');
            Flash::addFlash("Account Created");
            Utils::redirect('admin-list-administrator');
        }
    }
}
?>
