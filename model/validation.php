<?php
/**
 * Created by PhpStorm.
 * User: Vanteet
 * Date: 2/3/2019
 * Time: 6:17 PM
 */

function validateForm1($f3){
    //print_r($_POST);
    $bool = true;
    if (!isset($_POST['email']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
        $f3->set("errors['email']", "Please provide a valid email address");
        $bool = false;
    } else {
        $_SESSION['email'] = $_POST['email'];
    }
    if (!isset($_POST['state']) || !validState($_POST['state'])){
        $f3->set("errors['state']", "What is this? That was not a state");
        $bool = false;
    } else {
        $_SESSION['state'] = $_POST['state'];
    }
    if (!isset($_POST['seeking'])){
        $f3->set("errors['seeking']", "You either aren't seeking anything, or have come to the wrong site");
        $bool = false;
    } else {
        $_SESSION['seeking'] = $_POST['seeking'];
    }

    return $bool;
}

function validState($state){
    $states = array(
        'ALABAMA', 'ALASKA', 'ARIZONA', 'ARKANSAS', 'CALIFORNIA',
        'COLORADO', 'CONNECTICUT', 'DELAWARE', 'FLORIDA', 'GEORGIA', 'HAWAII',
        'IDAHO', 'ILLINOIS', 'INDIANA', 'IOWA', 'KANSAS', 'KENTUCKY', 'LOUISIANA', 'MAINE',
        'MARYLAND', 'MASSACHUSETTS', 'MICHIGAN', 'MINNESOTA', 'MISSISSIPPI',
        'MISSOURI', 'MONTANA', 'NEBRASKA', 'NEVADA', 'NEW HAMPSHIRE', 'NEW JERSEY',
        'NEW MEXICO', 'NEW YORK', 'NORTH CAROLINA', 'NORTH DAKOTA', 'OHIO', 'OKLAHOMA',
        'OREGON', 'PENNSYLVANIA', 'PUERTO RICO', 'RHODE ISLAND',
        'SOUTH CAROLINA', 'SOUTH DAKOTA', 'TENNESSEE', 'TEXAS', 'UTAH', 'VERMONT',
        'VIRGIN ISLANDS', 'VIRGINIA', 'WASHINGTON', 'WEST VIRGINIA', 'WISCONSIN', 'WYOMING');

    $state = strtoupper($state);
    if (in_array($state, $states)){
        return true;
    }
    return false;
}

function validateForm2(){
   // print_r($_POST);
   // print_r($_SESSION);

    $bool = true;
    if (!isset($_POST['fName'])){
        $bool = false;
    } else {
        $_SESSION['fName'] = $_POST['fName'];
    }
    if (!isset($_POST['lName'])){
        $bool = false;
    } else {
        $_SESSION['lName'] = $_POST['lName'];
    }
    if (!isset($_POST['age'])){
        $bool = false;
    } else {
        $_SESSION['age'] = $_POST['age'];
    }
    if (!isset($_POST['gender'])){
        $bool = false;
    } else {
        $_SESSION['gender'] = $_POST['gender'];
    }
    if (!isset($_POST['phone'])){
        $bool = false;
    } else {
        $_SESSION['phone'] = $_POST['phone'];
    }
    return $bool;
}

function validateForm3(){
   // print_r($_POST);
   // print_r($_SESSION);

    $bool = true;
    if (!isset($_POST['basic'])){
    $bool = false;
    } else {
        $_SESSION['basic'] = $_POST['basic'];
    }
    if (!isset($_POST['complicated'])){
        $bool = false;
    } else {
        $_SESSION['complicated'] = $_POST['complicated'];
    }

    return $bool;

}
