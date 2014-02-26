<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FileValidator
 *
 * @author Peter
 */
class FileValidator implements Validator {

    /**
     * Validate File
     * @param array $param
     */
    public static function validate(array $data) {
        $errors = array();
        $allowedExts = array("csv");
        $extension = self::getFileExtension($data['file']['name']);
        if (!(($data['file']["type"] == "application/vnd.ms-excel") && in_array($extension, $allowedExts))) {
            $errors[] =  new Error('file', 'invalid Format .csv required.');
        } elseif ($data['file']["error"] > 0) {
            $errors[] = new Error('file', 'File error.');
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
