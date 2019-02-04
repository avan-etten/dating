<?php
/**
 * Created by PhpStorm.
 * User: Vanteet
 * Date: 2/3/2019
 * Time: 6:17 PM
 */

function validateForm1(){
    print_r($_POST);
    $bool = true;
    if (!isset($_POST['email'])){
        $bool == false;
    }
    if (!isset($_POST['state']) || !validState($_POST['state'])){
        $bool == false;
    }
    if (!isset($_POST['seeking[]'])){
        $bool == false;
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

    strtoupper($state);
    if (in_array($state, $states)){
        return true;
    }
    return false;
}