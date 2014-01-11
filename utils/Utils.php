<?php

/**
 * Miscellaneous utility methods.
 */
final class Utils {

    private function __construct() {
        
    }

    /**
     * Generate link.
     * @param string $page target page
     * @param array $params page parameters
     */
    public static function createLink($page, array $params = array()) {
        $params = array_merge(array('page' => $page), $params);
        // TODO add support for Apache's module rewrite
        return 'index.php?' . http_build_query($params, '', '&');
    }

    /**
     * Format date.
     * @param DateTime $date date to be formatted
     * @return string formatted date
     */
    public static function formatDate(DateTime $date = null) {
        if ($date === null) {
            return '';
        }
        return $date->format('m/d/Y');
    }

    /**
     * Format date and time.
     * @param DateTime $date date to be formatted
     * @return string formatted date and time
     */
    public static function formatDateTime(DateTime $date = null) {
        if ($date === null) {
            return '';
        }
        return $date->format('m/d/Y H:i:s');
    }

    /**
     * Redirect to the given page.
     * @param type $page target page
     * @param array $params page parameters
     */
    public static function redirect($page, array $params = array()) {
        header('Location: ' . self::createLink($page, $params));
        die();
    }

    /**
     * Get value of the URL param.
     * @return string parameter value
     * @throws NotFoundException if the param is not found in the URL
     */
    public static function getUrlParam($name) {
        if (!array_key_exists($name, $_GET)) {
            throw new NotFoundException('URL parameter "' . $name . '" not found.');
        }
        return $_GET[$name];
    }

    /**
     * Get value of the URL param.
     * @return string parameter value
     * @throws NotFoundException if the param is not found in the URL
     */
    public static function postURLParam($name) {
        if (!array_key_exists($name, $_POST)) {
            throw new NotFoundException('URL parameter "' . $name . '" not found.');
        }
        return $_POST[$name];
    }

    /**
     * Get {@link University} by the identifier 'id' found in the URL.
     * @return University {@link University} instance
     * @throws NotFoundException if the param or {@link University} instance is not found
     */
    public static function getUniversityByGetId() {
        $id = null;
        try {
            $id = self::getUrlParam('id');
        } catch (Exception $ex) {
            throw new NotFoundException('No University identifier provided.');
        }
        if (!is_numeric($id)) {
            throw new NotFoundException('Invalid University identifier provided.');
        }
        $dao = new UniversityDao();
        $university = $dao->findById($id);
        if ($university === null) {
            throw new NotFoundException('Unknown University identifier provided.');
        }
        return $university;
    }

    /**
     * Get {@link Faculty} by the identifier 'id' found in the URL.
     * @return Faculty {@link Faculty} instance
     * @throws NotFoundException if the param or {@link Faculty} instance is not found
     */
    public static function getFacultyByGetId() {
        $id = null;
        try {
            $id = self::getUrlParam('id');
        } catch (Exception $ex) {
            throw new NotFoundException('No Faculty identifier provided.');
        }
        if (!is_numeric($id)) {
            throw new NotFoundException('Invalid Faculty identifier provided.');
        }
        $dao = new FacultyDao();
        $faculty = $dao->findById($id);
        if ($faculty === null) {
            throw new NotFoundException('Unknown Department identifier provided.');
        }
        return $faculty;
    }

    /**
     * Get {@link Department} by the identifier 'id' found in the URL.
     * @return Department {@link Department} instance
     * @throws NotFoundException if the param or {@link Department} instance is not found
     */
    public static function getDepartmentByGetId() {
        $id = null;
        try {
            $id = self::getUrlParam('id');
        } catch (Exception $ex) {
            throw new NotFoundException('No Department identifier provided.');
        }
        if (!is_numeric($id)) {
            throw new NotFoundException('Invalid Department identifier provided.');
        }
        $dao = new DepartmentDao();
        $department = $dao->findById($id);
        if ($department === null) {
            throw new NotFoundException('Unknown Department identifier provided.');
        }
        return $department;
    }

    /**
     * Get {@link Position} by the identifier 'id' found in the URL.
     * @return Position {@link Position} instance
     * @throws NotFoundException if the param or {@link Position} instance is not found
     */
    public static function getPositionByGetId() {
        $id = null;
        try {
            $id = self::getUrlParam('id');
        } catch (Exception $ex) {
            throw new NotFoundException('No Position identifier provided.');
        }
        if (!is_numeric($id)) {
            throw new NotFoundException('Invalid Position identifier provided.');
        }
        $dao = new PositionDao();
        $position = $dao->findById($id);
        if ($position === null) {
            throw new NotFoundException('Unknown Position identifier provided.');
        }
        return $position;
    }

    /**
     * Get {@link Election} by the identifier 'id' found in the URL.
     * @return Election {@link Election} instance
     * @throws NotFoundException if the param or {@link Election} instance is not found
     */
    public static function getElectionByGetId() {
        $id = null;
        try {
            $id = self::getUrlParam('id');
        } catch (Exception $ex) {
            throw new NotFoundException('No Election identifier provided.');
        }
        if (!is_numeric($id)) {
            throw new NotFoundException('Invalid Election identifier provided.');
        }
        $dao = new ElectionDao();
        $election = $dao->findById($id);
        if ($election === null) {
            throw new NotFoundException('Unknown Election identifier provided.');
        }
        return $election;
    }

    /**
     * Capitalize the first letter of the given string
     * @param string $string string to be capitalized
     * @return string capitalized string
     */
    public static function capitalize($string) {
        return ucfirst(mb_strtolower($string));
    }

    /**
     * Escape the given string
     * @param string $string string to be escaped
     * @return string escaped string
     */
    public static function escape($string) {
        return htmlspecialchars($string, ENT_QUOTES);
    }

    /**
     * Escape the given string
     * @param string $value
     * @return string
     */
    public static function mysqlPrep($value) {
        $magic_qoute_active = get_magic_quotes_gpc();
        $new_enough_php = function_exists("mysql_real_escape_string"); //for PHP >= 4.3.0

        if ($new_enough_php) {//
            if ($magic_qoute_active) {
                $value = stripslashes($value);
            }
            $value = mysql_real_escape_string($value);
        } else {
            if (!$magic_qoute_active) {
                $value = addslashes($value);
            }
        }
        return $value;
    }

    /**
     * 
     * @param type $university
     * @param type $faculty
     * @param type $department
     */
    public static function generateResult($university, $faculty, $department) {

        $chart = new PieChart();
        $positionDao = new PositionDao();
        $resultDao = new ResultDao();
        $positions = $positionDao->find();
        $result = array();
        foreach ($positions as $position) {
            $results = $resultDao->count($position, $university, $faculty, $department);
            $dataSet = new XYDataSet();
            foreach ($results as $result) {
                $dataSet->addPoint(new Point("{$result->getCandidate()}", $result->getCount()));
            }

            $chart->setDataSet($dataSet);

            $chart->setTitle("{$position->getName()} ");
            $chart->render("../result/{$position->getName()}.png");
        }
    }

    public static function error_field($title, array $errors) {
        foreach ($errors as $error) {
            /* @var $error Error */
            if ($error->getSource() == $title) {
                return ' error-field';
            }
        }
        return '';
    }

    public static function voterLoggedIn() {
        $var = array_key_exists('voterId', $_SESSION);
        return $var;
    }

    public static function voteLoggedIn() {
        $var = array_key_exists('voteId', $_SESSION);
        return $var;
    }

    public static function candidateLoggedIn() {
        $var = array_key_exists('candidateId', $_SESSION);
        return $var;
    }

    public static function adminLoggedIn() {
        $var = array_key_exists('adminId', $_SESSION);
        return $var;
    }

    public static function confirmVoterLogIn() {
        if (!self::voterLoggedIn()) {
            self::redirect('voter-login');
        }
    }

    public static function confirmCandidateLogIn() {
        if (!self::candidateLoggedIn()) {
            self::redirect('candidate-login');
        }
    }

    public static function confirmVoteLogIn() {
        if (!self::voteLoggedIn()) {
            self::redirect('vote-login');
        }
    }

    public static function confirmAdminLogIn() {
        if (!self::adminLoggedIn()) {
            self::redirect('admin-login');
        }
    }

    public static function voterLoggOut() {
        if (array_key_exists('voterId', $_SESSION)) {
            unset($_SESSION['voterId']);
            unset($_SESSION['Voter']);
            unset($_SESSION['matricNumber']);
        }
    }

    public static function voteLoggOut() {
        if (array_key_exists('voteId', $_SESSION)) {
            unset($_SESSION['voteId']);
            unset($_SESSION['voter']);
            unset($_SESSION['election']);
            unset($_SESSION['matricNumber']);
            unset($_SESSION['ballotbox']);
        }
    }

    public static function candidateLoggOut() {
        if (array_key_exists('candidateId', $_SESSION)) {
            unset($_SESSION['candidateId']);
            unset($_SESSION['candidate']);
            unset($_SESSION['matricNumber']);
        }
    }

    public static function adminLoggOut() {
        if (array_key_exists('adminId', $_SESSION)) {
            unset($_SESSION['adminId']);
            unset($_SESSION['admin']);
            unset($_SESSION['previouspage']);
            unset($_SESSION['matricNumber']);
        }
    }

    public static function random_text($count, $rm_similar = false) {
        // create list of characters
        $chars = array_flip(array_merge(range(0, 9), range('A', 'Z')));

        // remove similar looking characters that might cause confusion
        if ($rm_similar) {
            unset($chars[0], $chars[1], $chars[2], $chars[5], $chars[8], $chars['B'], $chars['I'], $chars['O'], $chars['Q'], $chars['S'], $chars['U'], $chars['V'], $chars['Z']);
        }

        // generate the string of random text
        for ($i = 0, $text = ''; $i < $count; $i++) {
            $text .= array_rand($chars);
        }

        return $text;
    }

}

?>
