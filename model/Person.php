<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Person
 *
 * @author Peter
 */
abstract class Person {

    //put your code here
    
    /**
     * id
     * @var int
     */
    protected $id;

    /**
     * Social Security Number
     * @var string
     */
    protected $matricNumber;

    /**
     * First Name
     * @var string
     */
    protected $firstName;

    /**
     * Last Name
     * @var string
     */
    protected $lastName;

    /**
     * Other Names
     * @var string
     */
    protected $otherNames;

    /**
     * Date of Birth
     * @var Date
     */
    //protected $dob;

    /**
     * @var int 
     * age
     */
    //protected $age;

    /**
     * Gender
     * @var Char
     */
    //protected $gender;

    /**
     * University
     * @var University
     */
    protected $university;

    /**
     * Faculty
     * @var Faculty
     */
    protected $faculty;

    /**
     * Department
     * @var Department
     */
    protected $department;

    /**
     * 
     * @var string
     */
    //protected $email;

    /**
     *
     * @var string
     */
    protected $password;
    

    /** @var DateTime */
    protected $createdOn;
    /** @var DateTime */
    protected $lastModifiedOn;
    
    
    
    /**
     * @var Char Male
     */

    //const GENDER_MALE = 'M';
    /**
     * @var Char Female
     */
   // const GENDER_FEMALE = 'F';

    public function __construct() {
        $now = new DateTime();
        $this->setCreatedOn($now);
        $this->setLastModifiedOn($now);
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
     * @param string $fname
     */
    public function setFirstName($fname) {

        $this->firstName = $fname;
    }

    /**
     * 
     * @param string $lname
     */
    public function setLastName($lname) {
        $this->lastName = $lname;
    }
    /**
     * 
     * @return string
     */
    public function getId() {
        return $this->id;
    }

    /**
     * 
     * @return string
     */
    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    /**
     * 
     * @return Date
     */
//    public function getDateOfBirth() {
//        return $this->dob;
//    }

    /**
     * 
     * @param DateTime $dob
     */
//    public function setDateOfBirth(DateTime $dob) {
//        $dob->format('Y/m/d');
//        $this->dob = $dob;
//    }

    /**
     * 
     * @return int
     */
//    public function getAge() {
//        $born = $this->dob;
//        $this->age = $born->diff(new DateTime())->format('%y');
//        return $this->age;
//    }

    /**
     * 
     * @return string
     */
    public function getMatricNumber() {
        return $this->matricNumber;
    }

    /**
     * 
     * @param string $ssn
     */
    public function setMatricNumber($ssn) {
        $this->matricNumber = $ssn;
    }

    /**
     * 
     * @return string
     */
//    public function getGender() {
//
//        return $this->gender;
//    }

    /**
     * 
     * @param string $gender
     */
//    public function setGender($gender) {
//        //PersonValidator::validateGender($gender);
//        $this->gender = $gender;
//    }
    
    /**
     * 
     * @return University
     */
    public function getUniversity() {

        return $this->university;
    }

    /**
     * 
     * @param University $university
     */
    public function setUniversity($university) {
        $this->university = $university;
    }

    /**
     * 
     * @return Faculty
     */
    public function getFaculty() {
        return$this->faculty;
    }

    /**
     * 
     * @param Faculty $faculty
     */
    public function setFaculty($faculty) {
        $this->faculty = $faculty;
    }

    /**
     * 
     * @return Department
     */
    public function getDepartment() {
        return $this->department;
    }

    /**
     * 
     * @param Department $department
     */
    public function setDepartment($department) {
        $this->department = $department;
    }

    /**
     * 
     * @return string
     */
    public function getOtherNames() {

        return $this->otherNames;
    }

    /**
     * 
     * @param string $other
     */
    public function setOtherNames($other) {
        $this->otherNames = $other;
    }

    /**
     * 
     * @return string
     */
//    public function getEmail() {
//        return $this->email;
//    }

    /**
     * 
     * @param string $email
     */
//    public function setEmail($email) {
//        $this->email = $email;
//    }

    /**
     * 
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * 
     * @param string $password
     */
    public function setPassword($password) {
        $this->password = $password;
    }

    

    /**
     * @return DateTime
     */
    public function getCreatedOn() {
        return $this->createdOn;
    }

    /**
     * 
     * @param DateTime $createdOn
     */
    public function setCreatedOn(DateTime $createdOn) {
        $this->createdOn = $createdOn;
    }
    /**
     * @return DateTime
     */
    public function getLastModifiedOn() {
        return $this->lastModifiedOn;
    }

    /**
     * 
     * @param DateTime $lastModifiedOn
     */
    public function setLastModifiedOn(DateTime $lastModifiedOn) {
        $this->lastModifiedOn = $lastModifiedOn;
    }
    /**
     * 
     * @return array
     */
//    public static function getAllGender() {
//        return array(self::GENDER_FEMALE, self::GENDER_MALE);
//    }

    
}

?>
