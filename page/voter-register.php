<?php
Utils::confirmAdminLogIn();
$universitydao = new UniversityDao();
$universities = $universitydao->find();
$electiondao = new ElectionDao();
$elections = $electiondao->find();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$errors = array();
if (array_key_exists('cancel', $_POST)) {
    Utils::redirect('admin-list-voter');
} elseif (array_key_exists('register', $_POST)) {
    $data = array(
        'firstname' => $_POST['data']['firstname']
        , 'lastname' => $_POST['data']['lastname']
        , 'othernames' => htmlspecialchars($_POST['data']['othernames'])
        , 'matricNumber' => $_POST['data']['matricNumber']
        , 'election_id' => $_POST['data']['election']
        , 'University_id' => $_POST['data']['university']
        , 'Faculty_id' => $_POST['data']['faculty']
        , 'department_id' => $_POST['data']['department']
        , 'password1' => $_POST['data']['password1']
        , 'password2' => $_POST['data']['password2']
    );
    $errors = VoterRegisterValidation::validate($data);
    $picData = array('avatar' => $_FILES['avatar']);
    if ($_FILES['avatar']['name'] == '') {
        $errors[] = new Error('picture', 'picture required.');
    } else {
        $picsError = PictureValidate::validate($picData);
        $errors = array_merge($errors, $picsError);
    }
    if (empty($errors)) {
        $voter = new Voter();
        $voterdao = new VoterDao();
        $voter = $voterdao->findByMatricNumber($data['matricNumber']);
        if ($voter->getId()) {
            $errors[] = new Error('matricNumber', 'matric number already registered.');
        } else {
            $password1 = $data['password1'];
            $password = sha1($password1);
            $voter->setPassword($password);
            VoterMapper::map($voter, $data);
            $voter = $voterdao->save($voter);
             if($voter->getId()){
                $electionData = array('voters_id' => $voter->getId(), 'elections_id'=> $data['election_id']);
                $electionHasVoter = new ElectionHasVoter();
                ElectionHasVoterMapper::map($electionHasVoter, $electionData);
                $electionHasVoterdao = new ElectionHasVoterDao();
                $electionHasVoterdao->save($electionHasVoter);
            }
            header('Content-Type: image/jpeg');
            $pic = new JpegThumbnail(130, 155);
            $pic->generate($_FILES['avatar']['tmp_name'], '../avatar/' . str_replace('/', '', $voter->getMatricNumber()) . '.jpg');
            Flash::addFlash("Account Created");
            Utils::redirect('admin-list-voter');
        }
    }
}
?>
