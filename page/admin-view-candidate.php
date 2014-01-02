
<?php 
Utils::confirmAdminLogIn();
$candidatedoa = new CandidateDao();
$candidate = $candidatedoa->findById(Utils::getUrlParam("candidateId"));
$universitydao = new UniversityDao();
$university  = $universitydao->findById($candidate->getUniversity());
$facultydao = new FacultyDao();
$faculty  = $facultydao->findById($candidate->getFaculty());
$departmentdao = new DepartmentDao();
$department  = $departmentdao->findById($candidate->getDepartment());
$positiondao = new PositionDao();
$position  = $positiondao->findbyId($candidate->getPosition());
$currentAdmin = unserialize(SessionManager::getSession('admin'));
if (array_key_exists('cancel', $_POST)) {
    // redirect
    Utils::redirect('admin-list-candidate');
}
?>