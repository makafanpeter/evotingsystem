<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Election
 *
 * @author Peter
 */
class Election {
    //put your code here

    /**
     *
     * @var int
     */
    private $id;

    /**
     *
     * @var string
     */
    private $name;

    /**
     *
     * @var DateTime
     */
    private $startTime;

    /**
     *
     * @var DateTime
     */
    private $endTime;

    public function __construct() {
        $now = new DateTime();
        $this->setStartTime($now);
    }

    /**
     * 
     * @param int $id
     */
    public function setId($id) {
         if ($this->id !== null && $this->id != $id) {
            throw new Exception('Cannot change identifier to ' . $id . ', already set to ' . $this->id);
        }
        $this->id = (int) $id;
    }

    /**
     * 
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * 
     * @param DateTime $starttime
     */
    public function setStartTime(DateTime $starttime) {
        $this->startTime = $starttime;
    }

    /**
     * 
     * @param DateTime $endtime
     */
    public function setEndTime(DateTime $endtime) {
        $this->endTime = $endtime;
    }

    /**
     * 
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * 
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * 
     * @return DateTime
     */
    public function getStartTime() {
        return $this->startTime;
    }

    /**
     * 
     * @return DateTime
     */
    public function getEndTime() {
        return $this->endTime;
    }

    /**
     * 
     * @return boolean
     */
    public function isElectionOn() {
        $now = new DateTime();
        if ($now >= $this->getStartTime() && $now <= $this->getEndTime()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @return boolean
     */
    public function isElectionOff() {
        $now = new DateTime();
        if ($now > $this->getEndTime()) {
            return true;
        } else {
            return false;
        }
    }

}

?>
