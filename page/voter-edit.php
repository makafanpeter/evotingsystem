<?php

Utils::confirmVoterLogIn();
$voterDao = new VoterDao();
$voter = $voterDao->findById(SessionManager::getSession('voterId'));
$universitydao = new UniversityDao();
$university = $universitydao->findById($voter->getUniversity());
$facultydao = new FacultyDao();
$faculty = $facultydao->findById($voter->getFaculty());
$departmentdao = new DepartmentDao();
$department = $departmentdao->findById($voter->getDepartment());
$errors = array();
$picsError = array();
if (array_key_exists('save', $_POST)) {


    $data = array(
        'firstname' => $_POST['data']['firstname']
        , 'lastname' => $_POST['data']['lastname']
        , 'othernames' => htmlspecialchars($_POST['data']['othernames'])        
        , 'password1' => $_POST['data']['password1']
        , 'password2' => $_POST['data']['password2']
    );
    $errors = Validate::validate($data);
    if ($_FILES['avatar']['name'] != '') {
        $picData = array('avatar' => $_FILES['avatar']);
        $picsError = PictureValidate::validate($picData);
        $errors = array_merge($errors, $picsError);
    }
    if (empty($errors)) {
        $password1 = (isset($_POST['data']['password1']) && $_POST['data']['password1']) ?
                sha1($_POST['data']['password1']) : $voter->getPassword();
        $password2 = (($_POST['data']['password2']) && $_POST['data']['password2']) ?
                sha1($_POST['data']['password2']) : $voter->getPassword();
        $password = ($password1 == $password2) ? $password1 : $voter->getPassword();
        VoterMapper::map($voter, $data);
        $voter->setPassword($password);
        $voterDao->save($voter);
        if ($_FILES['avatar']['name'] != '') {
            header('Content-Type: image/jpeg');
            $pic = new JpegThumbnail(130, 155);
            $pic->generate($_FILES['avatar']['tmp_name'], '../avatar/' . str_replace('/', '', $voter->getMatricNumber()) . '.jpg');
        }
        Flash::addFlash("Profile Edited");
        Utils::redirect('voter-view');
    }
}
if (array_key_exists('cancel', $_POST)) {
    Utils::redirect('voter-home');
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
