<?php
/**
 * Created by PhpStorm.
 * User: Vanteet
 * Date: 2/16/2019
 * Time: 3:47 PM
 */
/**
 * The Member class represents a member of the dating site
 *
 * The Member has a first name, last name, age, gender, phone number, email address,
 * state of residence, and a bio.
 * @author Alec Van Etten <avan-etten@mail.greenriver.edu>
 * @copyright 2019
 */
class Member
{

    private $_fName;
    private $_lName;
    private $_age;
    private $_gender;
    private $_phone;
    private $_email;
    private $_state;
    private $_seeking;
    private $_bio;

    /**
     * Member constructor.
     * @param String $fName
     * @param String $lName
     * @param int $age
     * @param String $gender
     * @param String $phone
     */
    function __construct($fName, $lName, $age, $gender, $phone){
        $this->_fName = $fName;
        $this->_lName = $lName;
        $this->_age = $age;
        $this->_gender = $gender;
        $this->_phone = $phone;
    }

    /**
     * @return String first name
     */
    public function getFname()
    {
        return $this->_fName;
    }

    /**
     * @param String $fname
     */
    public function setFname($fName)
    {
        $this->_fName = $fName;
    }

    /**
     * @return String last name
     */
    public function getLname()
    {
        return $this->_lName;
    }

    /**
     * @param String $lname
     */
    public function setLname($lName)
    {
        $this->_lName = $lName;
    }

    /**
     * @return int age
     */
    public function getAge()
    {
        return $this->_age;
    }

    /**
     * @param int $age
     */
    public function setAge($age)
    {
        $this->_age = $age;
    }

    /**
     * @return String gender.
     */
    public function getGender()
    {
        return $this->_gender;
    }

    /**
     * @param String $gender
     */
    public function setGender($gender)
    {
        $this->_gender = $gender;
    }

    /**
     * @return String phone number
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * @param String $phone
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * @return String email
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param String $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return String state
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * @param String $state
     */
    public function setState($state)
    {
        $this->_state = $state;
    }

    /**
     * @return String seeking
     */
    public function getSeeking()
    {
        return $this->_seeking;
    }

    /**
     * @param String $seeking
     */
    public function setSeeking($seeking)
    {
        $this->_seeking = $seeking;
    }

    /**
     * @return String bio
     */
    public function getBio()
    {
        return $this->_bio;
    }

    /**
     * @param String $bio
     */
    public function setBio($bio)
    {
        $this->_bio = $bio;
    }


}