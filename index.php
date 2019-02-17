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
/*try {
    //Instantiate a database object
    $dbh= new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    //echo 'Connected to database!';
}
catch(PDOException$e) {
    echo$e->getMessage();
}*/

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
    $member = $_SESSION['member'];
    $_SESSION['fName'] = $member->getFname();
    $_SESSION['lName'] = $member->getLname();
    $_SESSION['age'] = $member->getAge();
    $_SESSION['gender'] = $member->getGender();
    $_SESSION['email'] = $member->getEmail();
    $_SESSION['phone'] = $member->getPhone();
    $_SESSION['state'] = $member->getState();
    $_SESSION['seeking'] = $member->getSeeking();
    $_SESSION['basic'] = $member->getBasicInterests();
    $_SESSION['complicated'] = $member->getComplicatedInterests();

    $template = new Template;
    echo $template->render('views/summary.html');
});

//run fat free
$f3->run();