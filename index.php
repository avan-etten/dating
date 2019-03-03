<?php
/**
 * Created by PhpStorm.
 * User: Alec Van Etten
 * Date: 1/18/2019
 * Time: 2:34 AM
 */

//turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//require autoload
require_once "vendor/autoload.php";

require_once "model/validation.php";

//Connect to DB
//require '/home/avanette/config.php';


//Create an instance of the Base class
$f3 = Base::instance();



$f3->set('DEBUG', 3);
//define a default route
$f3->route('GET|POST /', function() {
    $_POST = array();
    session_start();
    $_SESSION = array();

    $template = new Template;
    echo $template->render('views/home.html');
});

//define route for profile form
$f3->route('GET|POST /form1', function($f3) {
    session_start();
   // print_r($_POST);
    if (!empty($_POST)) {
        if (validateForm1($f3)) {
            if (!isset($_POST['premium'])) {
                $member = new Member($_POST['fName'], $_POST['lName'],
                    $_POST['age'], $_POST['gender'], $_POST['phone']);
            } else {
                $member = new PremiumMember($_POST['fName'], $_POST['lName'],
                    $_POST['age'], $_POST['gender'], $_POST['phone']);
            }
            $_SESSION['member'] = $member;

            $f3->reroute('/form2');
        }
    }
    $template = new Template;
    echo $template->render('views/personal.html');
});

//define route for personal form
$f3->route('GET|POST /form2', function($f3) {
    session_start();
   // print_r($_SESSION);
    if (!empty($_POST))
    if (validateForm2($f3)){

        $member = $_SESSION['member'];
        $member->setEmail($_POST['email']);
        $member->setState($_POST['state']);
        $member->setSeeking($_POST['seeking']);
        $_SESSION['member'] = $member;
        $f3->reroute('/form3');
    }

    $template = new Template;
    echo $template->render('views/profile.html');
});

//define route for interests form
$f3->route('GET|POST /form3', function($f3) {
    session_start();

    if (!empty($_POST)) {
        if (validateForm3($f3)) {
            $premiumMember = $_SESSION['member'];
            $premiumMember->setBasicInterests($_POST['basic']);
            $premiumMember->setComplicatedInterests($_POST['complicated']);
            $_SESSION['member'] = $premiumMember;
            $f3->reroute('/profile');
        }
    }

    $template = new Template;
    echo $template->render('views/interests.html');
});

//define route for profile summary
$f3->route('GET|POST /profile', function($f3) {
    session_start();
    //print_r($_SESSION);
    $dbh = new db();
    $dbh->_connect();

    $dbh->_insertMember();

    $result = $dbh->_getMembers();
    //$member = $_SESSION['member'];
    foreach ($result as $row) {
        $_SESSION['fName'] = $row['first'];
        $_SESSION['lName'] = $row['last'];
        $_SESSION['age'] = $row['age'];
        $_SESSION['gender'] = $row['gender'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['phone'] = $row['phone'];
        $_SESSION['state'] = $row['state'];
        $_SESSION['seeking'] = $row['seeking'];
        $_SESSION['basic'] = $row['interests'];

    }

    $template = new Template;
    echo $template->render('views/summary.html');
});

//run fat free
$f3->run();