<?php
/**
 * Created by PhpStorm.
 * User: Vanteet
 * Date: 2/16/2019
 * Time: 3:55 PM
 */

class PremiumMember extends Member
{
    private $_basicInterests;
    private $_complicatedInterests;

    public function __construct($fname, $lname, $age, $gender, $phone){
        parent::__construct($fname, $lname, $age, $gender, $phone);
    }

    /**
     * @return String array
     */
    public function getBasicInterests()
    {
        return $this->_basicInterests;
    }

    /**
     * @param String array $basicInterests
     */
    public function setBasicInterests($basicInterests)
    {
        $this->_basicInterests = $basicInterests;
    }

    /**
     * @return String array
     */
    public function getComplicatedInterests()
    {
        return $this->_complicatedInterests;
    }

    /**
     * @param String array $complicatedInterests
     */
    public function setComplicatedInterests($complicatedInterests)
    {
        $this->_complicatedInterests = $complicatedInterests;
    }

}