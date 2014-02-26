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
        'election_id' => $_POST['data']['election']
        , 'University_id' => $_POST['data']['university']
        , 'Faculty_id' => $_POST['data']['faculty']
        , 'department_id' => $_POST['data']['department']
    );
    $errors = VoterRegisterValidation::validateFileUpload($data);
    $fileData = array('file' => $_FILES['csvdoc']);
    if ($_FILES['csvdoc']['name'] == '') {
        $errors[] = new Error('file', 'Csv File required.');
    } else {
        $fileError = FileValidator::validate($fileData);
        $errors = array_merge($errors, $fileError);
    }
    if (empty($errors)) {
        $voter = new Voter();
        $voter->setDepartment($data['department_id']);
        $voter->setFaculty('Faculty_id');
        $voter->setUniversity('University_id');
        $voterdao = new VoterDao();
        $rowsImported = 0;
        $row = 1;
        if (($handle = fopen($file->getTempName(), "r")) !== FALSE) {
            while (($csvData = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($csvData);
                $temp = array();
                $row++;
                if ($row != 2) {
                    for ($c = 0; $c < $num; $c++) {
                        $temp[] = $csvData[$c];
                    }
                    $voter->setPassword(Utils::random_text(4));
                    $result = CSVImport::import($temp);
                    if ($result !== FALSE) {
                        $data = array_merge($data, $result);
                        VoterMapper::map($voter, $data);
                        $voter = $voterdao->save($voter);
                    }

                    if ($voter->getId()) {
                        $electionData = array('voters_id' => $voter->getId(), 'elections_id' => $data['election_id']);
                        $electionHasVoter = new ElectionHasVoter();
                        ElectionHasVoterMapper::map($electionHasVoter, $electionData);
                        $electionHasVoterdao = new ElectionHasVoterDao();
                        $electionHasVoterdao->save($electionHasVoter);
                    }
                    if ($result) {
                        $rowsImported++;
                    }
                }
            }
            fclose($handle);
        }
        $rowsImported;
        /**

          $voter = $voterdao->findByMatricNumber($data['matricNumber']);
          if ($voter->getId()) {
          $errors[] = new Error('matricNumber', 'matric number already registered.');
          } else {

          $password1 = $data['password1'];
          $password = sha1($password1);



          header('Content-Type: image/jpeg');
          $pic = new JpegThumbnail(130, 155);
          $pic->generate($_FILES['avatar']['tmp_name'], '../avatar/' . str_replace('/', '', $voter->getMatricNumber()) . '.jpg');
          Flash::addFlash("Account Created");
          Utils::redirect('admin-list-voter');
          }
         */
    }
}
?>
