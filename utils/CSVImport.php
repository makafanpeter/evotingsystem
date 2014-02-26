<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CSVImport
 *
 * @author Peter
 */
class CSVImport {

    /**
     * 
     * @param array $data
     */
    public static function import(array $data) {

        if ($data[0] == "" || $data[2] == "" || strlen($data[0]) > 30 || strlen($data[2]) > 30) {
            return false;
        }
        $import = array();
        $import['matricNumber'] = $data[0];
        $import['firstname'] = $data[1];
        $import['lastname'] = $data[2];
        if (strlen($data[3]) <= 30) {
            $import['othernames'] = $data[3];
        }
        return $import;
    }

}
