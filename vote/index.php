<?php

/**
 * Main application class.
 */
final class Index {

    const DEFAULT_PAGE = 'vote-login';
    const PAGE_DIR = '../page/';
    const LAYOUT_DIR = '../layout/';

    private static $validPages = array('vote-login', 'vote-home', 'vote',
        'vote-ballotbox', 'vote-confirmation', 'vote-position', 'vote-cast', 'vote-confirmation', '404', '500');

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
            'Flash' => '../flash/Flash.php',
            'Utils' => '../utils/Utils.php',
            'JpegThumbnail' => '../utils/JpegThumbnail.php',
            'Config' => '../config/Config.php',
            'Administrator' => '../model/Administrator.php',
            'BallotBox' => '../model/BallotBox.php',
            'Candidate' => '../model/Candidate.php',
            'CandidateDao' => '../dao/CandidateDao.php',
            'CandidateMapper' => '../mapping/CandidateMapper.php',
            'Department' => '../model/Department.php',
            'Faculty' => '../model/Faculty.php',
            'Person' => '../model/Person.php',
            'Position' => '../model/Position.php',
            'PositionDao' => '../dao/PositionDao.php',
            'PositionMapper' => '../mapping/PositionMapper.php',
            'University' => '../model/University.php',
            'VoteManager' => '../model/VoteManager.php',
            'ResultDao' => '../dao/ResultDao.php',
            'Result' => '../model/Result.php',
            'ResultMapper' => '../mapping/ResultMapper.php',
            'LoginValidation' => '../validation/LoginValidation.php',
            'Validation' => '../validation/Validation.php',
            'Validator' => '../validation/Validator.php',
            'Voter' => '../model/Voter.php',
            'VoterDao' => '../dao/VoterDao.php',
            'VoterMapper' => '../mapping/VoterMapper.php',
            'SessionManager' => '../utils/SessionManager.php',
            'Error' => '../validation/Error.php',
            'Election' => '../model/Election.php',
            'ElectionDao' => '../dao/ElectionDao.php',
            'ElectionMapper' => '../mapping/ElectionMapper.php',
            'ElectionHasVoter' => '../model/ElectionHasVoter.php',
            'ElectionHasCandidate' => '../model/ElectionHasCandidate.php',
            'ElectionHasCandidateDao' => '../dao/ElectionHasCandidateDao.php',
            'ElectionHasVoterDao' => '../dao/ElectionHasVoterDao.php',
            'ElectionHasVoterMapper' => '../mapping/ElectionHasVoterMapper.php',
            'ElectionHasCandidateMapper' => '../mapping/ElectionHasCandidateMapper.php'
        );
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
            require self::LAYOUT_DIR . 'vote.phtml';
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
