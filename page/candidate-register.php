<?php
Utils::confirmAdminLogIn();
$positiondao = new PositionDao();
$universitydao = new UniversityDao();
$electiondao = new ElectionDao();
$elections = $electiondao->find();
$universities = $universitydao->find();
$positions = $positiondao->find();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$errors = array();
if (array_key_exists('cancel', $_POST)) {
    Utils::redirect('admin-list-candidate');
} elseif (array_key_exists('register', $_POST)) {
    $data = array(
        'firstname' => $_POST['data']['firstname']
        , 'lastname' => $_POST['data']['lastname']
        , 'othernames' => Utils::escape($_POST['data']['othernames'])
        , 'matricNumber' => $_POST['data']['matricNumber']
        , 'election_id' => $_POST['data']['election']
        , 'position_id' => $_POST['data']['position']
        , 'University_id' => $_POST['data']['university']
        , 'Faculty_id' => $_POST['data']['faculty']
        , 'department_id' => $_POST['data']['department']
        , 'password1' => $_POST['data']['password1']
        , 'password2' => $_POST['data']['password2']
    );
    $errors = CandidateRegisterValidation::validate($data);
    $picData = array('avatar' => $_FILES['avatar']);
    if ($_FILES['avatar']['name'] == '') {
        $errors[] = new Error('picture', 'picture required.');
    } else {
        $picsError = PictureValidate::validate($picData);
        $errors = array_merge($errors, $picsError);
    }
    if (empty($errors)) {
        $candidate = new Candidate();
        $candidatedao = new CandidateDao();
        $candidate = $candidatedao->findByMatricNumber($data['matricNumber']);
        if ($candidate->getId()) {
            $errors[] = new Error('matricNumber', 'matric number already registered.');
        } else {
            $password1 = $data['password1'];
            $password = sha1($password1);
            $candidate->setPassword($password);
            CandidateMapper::map($candidate, $data);
            $candidate = $candidatedao->save($candidate);
            if($candidate->getId()){
                $electionData = array('candidates_id' => $candidate->getId(), 'elections_id'=> $data['election_id']);
                $electionHasCandidate = new ElectionHasCandidate();
                ElectionHasCandidateMapper::map($electionHasCandidate, $electionData);
                $electionHasCandidatedao = new ElectionHasCandidateDao();
                $electionHasCandidatedao->save($electionHasCandidate);
            }
            header('Content-Type: image/jpeg');
            $pic = new JpegThumbnail(130, 155);
            $pic->generate($_FILES['avatar']['tmp_name'], '../avatar/' . str_replace('/', '', $candidate->getMatricNumber()) . '.jpg');
            Flash::addFlash("Account Created");
            Utils::redirect('admin-list-candidate');
        }
    }
}
?>
