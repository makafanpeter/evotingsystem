<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Descriptaion of PictureValidate
 *
 * @author Peter
 */
class PictureValidate implements Validator{

    //put your code here
    public function __construct() {
        
    }

    /**
     * 
     * @param array $data
     * @return \Error
     */
    public static function validate(array $data) {
        $errors = array();
        $allowedExts = array("jpeg", "jpg");
        $extension = self::getFileExtension($data['avatar']['name']);
        if (!((($data['avatar']["type"] == "image/jpeg") || ($data['avatar']["type"] == "image/jpg")) && ($data['avatar']["size"] < 3000000) && in_array($extension, $allowedExts))) {
            $errors[] = new Error('picture', 'Pics too large 3MB or less required or invalid Format JPEG required.');
        } elseif ($data['avatar']["error"] > 0) {
            $errors[] = new Error('picture', 'File error.');
        }
        return $errors;
    }

    private static function getFileExtension($filepath) {
        $lastdot = strrpos($filepath, ".");
        if ($lastdot === FALSE) {
            return FALSE;
        }
        $filetype = strtolower(substr($filepath, $lastdot + 1));
        return $filetype;
    }

}

?>
