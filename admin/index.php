<?php

/**
 * Main application class.
 */
final class Index {

    const DEFAULT_PAGE = 'admin-login';
    const PAGE_DIR = '../page/';
    const LAYOUT_DIR = '../layout/';

    private static $validPages = array('admin-login', 'admin-home',
        'admin-result', 'admin-view', 'admin-edit', '401', '404', '500',
        'add-edit-department', 'add-edit-election', 'add-edit-faculty',
        'add-edit-position', 'add-edit-university', 'admin-add', 'admin-edit',
        'admin-list-candidate', 'admin-list-department', 'admin-list-election',
        'admin-list-faculty', 'delete', 'admin-list-election', 'admin-list-faculty', 'admin-list-position',
        'admin-list-university', 'admin-list-voter', 'admin-result-pie',
        'candidate-register', 'voter-register','csv-import', 'admin-list-administrator', 'admin-view-candidate');

    /**
     * System config.
     */
    public function init() {
        // error reporting - all errors for development (ensure you have display_errors = On in your php.ini file)
        error_reporting(E_ALL | E_STRICT);
        mb_internal_encoding('UTF-8');
        set_exception_handler(array($this, 'handleException'));
        spl_autoload_register(array($this, 'loadClass'));
        // session
        session_start();
        // set time zone to use date/time functions without warnings
        date_default_timezone_set('Africa/Lagos');
    }

    /**
     * Run the application!
     */
    public function run() {
        $this->runPage($this->getPage());
    }

    /**
     * Exception handler.
     */
    public function handleException(Exception $ex) {
        $extra = array('message' => $ex->getMessage());
        if ($ex instanceof NotFoundException) {
            header('HTTP/1.0 404 Not Found');
            $this->runPage('404', $extra);
        } elseif ($ex instanceof UnauthorizedException) {
            header('HTTP/1.0 401 Unauthorized');
            $this->runPage('401', $extra);
        } else {
            // TODO log exception
            header('HTTP/1.1 500 Internal Server Error');
            $this->runPage('500', $extra);
        }
    }

    /**
     * Class loader.
     */
    public function loadClass($name) {
        $classes = array(
            'NotFoundException' => '../exception/NotFoundException.php',
            'UnauthorizedException' => '../exception/UnauthorizedException.php',
            'Flash' => '../flash/Flash.php',
            'Utils' => '../utils/Utils.php',
            'JpegThumbnail' => '../utils/JpegThumbnail.php',
            'SessionManager' => '../utils/SessionManager.php',
            'CSVImport'=>'../utils/CSVImport.php',
            'Administrator' => '../model/Administrator.php',
            'AdministratorMapper' => '../mapping/AdministratorMapper.php',
            'AdministratorDao' => '../dao/AdministratorDao.php',
            'LoginValidation' => '../validation/LoginValidation.php',
            'Error' => '../validation/Error.php',
            'Validation' => '../validation/Validation.php',
            'Validate' => '../validation/Validate.php',
            'Validator' => '../validation/Validator.php',
            'PictureValidate' => '../validation/PictureValidate.php',
            'FileValidator' =>'../validation/FileValidator.php',
            'CandidateRegisterValidation' => '../validation/CandidateRegisterValidation.php',
            'VoterRegisterValidation' => '../validation/VoterRegisterValidation.php',
            'AdminValidator' => '../validation/AdminValidator.php',
            'ElectionValidator' => '../validation/ElectionValidator.php',
            'UniversityValidator' => '../validation/UniversityValidator.php',
            'DepartmentValidator' => '../validation/DepartmentValidator.php',
            'FacultyValidator' => '../validation/FacultyValidator.php',
            'PositionValidator' => '../validation/PositionValidator.php',
            'Candidate' => '../model/Candidate.php',
            'CandidateDao' => '../dao/CandidateDao.php',
            'CandidateMapper' => '../mapping/CandidateMapper.php',
            'Department' => '../model/Department.php',
            'DepartmentMapper' => '../mapping/DepartmentMapper.php',
            'DepartmentDao' => '../dao/DepartmentDao.php',
            'Faculty' => '../model/Faculty.php',
            'FacultyMapper' => '../mapping/FacultyMapper.php',
            'FacultyDao' => '../dao/FacultyDao.php',
            'Person' => '../model/Person.php',
            'Position' => '../model/Position.php',
            'PositionMapper' => '../mapping/PositionMapper.php',
            'PositionDao' => '../dao/PositionDao.php',
            'University' => '../model/University.php',
            'UniversityDao' => '../dao/UniversityDao.php',
            'UniversityMapper' => '../mapping/UniversityMapper.php',
            'Config' => '../config/Config.php',
            'Voter' => '../model/Voter.php',
            'VoterDao' => '../dao/VoterDao.php',
            'VoterMapper' => '../mapping/VoterMapper.php',
            'ResultDao' => '../dao/ResultDao.php',
            'ResultMapper' => '../mapping/ResultMapper.php',
            'Result' => '../model/Result.php',
            'Election' => '../model/Election.php',
            'ElectionDao' => '../dao/ElectionDao.php',
            'ElectionMapper' => '../mapping/ElectionMapper.php',
            'ElectionHasVoter' => '../model/ElectionHasVoter.php',
            'ElectionHasCandidate' => '../model/ElectionHasCandidate.php',
            'ElectionHasCandidateDao' => '../dao/ElectionHasCandidateDao.php',
            'ElectionHasVoterDao' => '../dao/ElectionHasVoterDao.php',
            'ElectionHasVoterMapper' => '../mapping/ElectionHasVoterMapper.php',
            'ElectionHasCandidateMapper' => '../mapping/ElectionHasCandidateMapper.php',
            'ChartConfig' => '../utils/libchart/classes/model/ChartConfig.php',
            'Point' => '../utils/libchart/classes/model/Point.php',
            'DataSet' => '../utils/libchart/classes/model/DataSet.php',
            'XYDataSet' => '../utils/libchart/classes/model/XYDataSet.php',
            'XYSeriesDAtaSet' => '../utils/libchart/classes/model/XYSeriesDataSet.php',
            'Padding' => '../utils/libchart/classes/view/primitive/Padding.php',
            'Rectangle' => '../utils/libchart/classes/view/primitive/Rectangle.php',
            'Primitive' => '../utils/libchart/classes/view/primitive/Primitive.php',
            'Text' => '../utils/libchart/classes/view/text/Text.php',
            'Color' => '../utils/libchart/classes/view/color/Color.php',
            'ColorSet' => '../utils/libchart/classes/view/color/ColorSet.php',
            'Palette' => '../utils/libchart/classes/view/color/Palette.php',
            'Bound' => '../utils/libchart/classes/view/axis/Bound.php',
            'Axix' => '../utils/libchart/classes/view/axis/Axis.php',
            'Plot' => '../utils/libchart/classes/view/plot/Plot.php',
            'Caption' => '../utils/libchart/classes/view/caption/Caption.php',
            'Chart' => '../utils/libchart/classes/view/chart/Chart.php',
            'BarChart' => '../utils/libchart/classes/view/chart/BarChart.php',
            'VerticalBarChart' => '../utils/libchart/classes/view/chart/VerticalBarChart.php',
            'HorizontalBarChart' => '../utils/libchart/classes/view/chart/HorizontalBarChart.php',
            'LineChart' => '../utils/libchart/classes/view/chart/LineChart.php',
            'PieChart' => '../utils/libchart/classes/view/chart/PieChart.php');
        if (!array_key_exists($name, $classes)) {
            die('Class "' . $name . '" not found.');
        }
        require_once $classes[$name];
    }

    private function getPage() {
        $page = self::DEFAULT_PAGE;
        if (array_key_exists('page', $_GET)) {
            $page = $_GET['page'];
        }
        return $this->checkPage($page);
    }

    private function checkPage($page) {
        if (!preg_match('/^[a-z0-9-]+$/i', $page)) {
            // TODO log attempt, redirect attacker, ...
            throw new NotFoundException('Unsafe page "' . $page . '" requested');
        }
        if ((!$this->hasScript($page) && !$this->hasTemplate($page)) || (!in_array($page, Index::$validPages))) {
            // TODO log attempt, redirect attacker, ...
            throw new NotFoundException('Page "' . $page . '" not found');
        }
        return $page;
    }

    private function runPage($page, array $extra = array()) {
        $run = false;
        if ($this->hasScript($page)) {
            $run = true;
            require $this->getScript($page);
        }
        if ($this->hasTemplate($page)) {
            $run = true;
            // data for main template
            $template = $this->getTemplate($page);
            $flashes = null;

            if (Flash::hasFlashes()) {
                $flashes = Flash::getFlashes();
            }

            // main template (layout)
            require self::LAYOUT_DIR . 'admin.phtml';
        }
        if (!$run) {
            die('Page "' . $page . '" has neither script nor template!');
        }
    }

    private function getScript($page) {
        return self::PAGE_DIR . $page . '.php';
    }

    private function getTemplate($page) {
        return self::PAGE_DIR . $page . '.phtml';
    }

    private function hasScript($page) {
        return file_exists($this->getScript($page));
    }

    private function hasTemplate($page) {
        return file_exists($this->getTemplate($page));
    }

}

$index = new Index();
$index->init();
// run application!
$index->run();
?>
