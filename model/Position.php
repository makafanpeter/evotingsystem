<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Position
 *
 * @author Peter
 */
class Position {
    //put your code here

    /**
     * National Level
     */

    const NATIONAL_LEVEL = 'university';
    /**
     * State Level
     */
    const STATE_LEVEL = 'faculty';
    /**
     * Local Level
     */
    const LOCAL_LEVEL = 'department';

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
     * @var int
     */
    private $positionLevel;
    
    /**
     *
     * @var bool 
     */
    private $isMultiple;

    public function __construct() {
        
    }

    /**
     * 
     * @param int $id
     * @throws Exception
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
     * @param int $position
     */
    public function setPostionLevel($position) {
        $this->positionLevel = $position;
    }
    
    public function setIsMultiple($multiple = false){
        $this->isMultiple = (bool) $multiple;
    }

    /**
     * 
     * @return array
     */
    public static function allPositionLevel() {
        return array(self::NATIONAL_LEVEL, self::STATE_LEVEL, self::LOCAL_LEVEL);
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
     * @return bool
     */
    public function getIsMutiple(){
        return (bool) $this->isMultiple;
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
     * @return int
     */
    public function PositionLevel() {
        switch ($this->positionLevel) {
            case Position::NATIONAL_LEVEL:
                return 3;
                break;
            case Position::STATE_LEVEL:
                return 2;
                break;
            case Position::LOCAL_LEVEL:
                return 1;
                break;
        }
    }
    public function getPositionLevel() {
        return $this->positionLevel;
    }

}

?>
