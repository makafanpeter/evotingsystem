<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PositionValidator
 *
 * @author Peter
 */
class PositionValidator extends Validation implements Validator {
    //put your code here
    public function __construct() {
        
    }

    /**
     * 
     * @param array $data
     */
    public static function validate(array $data) {
        $errors = array();
        if (empty($data['name'])) {
            $errors[] = new Error('name', 'Empty Name Field.');
        }
        if (empty($data['level'])) {
            $errors[] = new Error('level', 'Invalid level selected.');
        }elseif (!self::isValidLevel($data['level'])) {
            $errors[] = new Error('level', 'Invalid level set.');
        }
        return $errors;
    }
    
   /** Validate the given level.
     * @param int $level level to be validated
     * @throws Exception if the level is not known
     */
    public static function validateLevel($level) {
        if (!self::isValidLevel($level)) {
            throw new Exception('Unknown level: ' . $level);
        }
    }
    
    private static function isValidLevel($level) {
        return in_array($level, Position::allPositionLevel());
    }
}

?>
