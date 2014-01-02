<?php
Utils::confirmAdminLogIn();
$currentAdmin = unserialize(SessionManager::getSession('admin'));
if (!($currentAdmin->getRole() === 'super')) {
    throw new UnauthorizedException('You are not authorized to perform this operation.');
}
if (isset($_GET['universityId']) && is_numeric($_GET['universityId'])) {
    $dao = new UniversityDao();
    if ($dao->delete($_GET['universityId'])) {
        Flash::addFlash('University deleted successfully.');
    } else {
        Flash::addFlash('University not deleted.');
    }
} elseif (isset($_GET['facultyId']) && is_numeric($_GET['facultyId'])) {
    $dao = new FacultyDao();
    if ($dao->delete($_GET['facultyId'])) {
        Flash::addFlash('Faculty deleted successfully.');
    } else {
        Flash::addFlash('Faculty not deleted.');
    }
} elseif (isset($_GET['departmentId']) && is_numeric($_GET['departmentId'])) {
    $dao = new DepartmentDao();
    if ($dao->delete($_GET['departmentId'])) {
        Flash::addFlash('Department deleted successfully.');
    } else {
        Flash::addFlash('Department not deleted.');
    }
} elseif (isset($_GET['electionId']) && is_numeric($_GET['electionId'])) {
    $dao = new ElectionDao();
    if ($dao->delete($_GET['electionId'])) {
        Flash::addFlash('Election deleted successfully.');
    } else {
        Flash::addFlash('Election not deleted.');
    }
} elseif (isset($_GET['positionId']) && is_numeric($_GET['positionId'])) {
    $dao = new PositionDao();
    if ($dao->delete($_GET['positionId'])) {
        Flash::addFlash('Position deleted successfully.');
    } else {
        Flash::addFlash('Position not deleted.');
    }
}

Utils::redirect(SessionManager::getSession('previouspage'));
?>
