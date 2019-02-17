<?php
/**
 * Created by PhpStorm.
 * User: Vanteet
 * Date: 2/16/2019
 * Time: 3:55 PM
 */

/**
 * The PremiumMember class represents a member with premium status
 *
 * The PremiumMember has all the attributes of a member with the addition of interests, basic
 * and complicated.
 * @author Alec Van Etten <avan-etten@mail.greenriver.edu>
 * @copyright 2019
 */
class PremiumMember extends Member
{
    private $_basicInterests;
    private $_complicatedInterests;

    function __construct($fName, $lName, $age, $gender, $phone){
        parent::__construct($fName, $lName, $age, $gender, $phone);
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