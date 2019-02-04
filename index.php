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

//Create an instance of the Base class
$f3 = Base::instance();


$f3->set('DEBUG', 3);
//define a default route
$f3->route('GET|POST /', function() {
    $_POST = array();
    session_start();
    $_SESSION = array();

    $view = new View;
    echo $view->render('views/home.html');
});

//define route for profile form
$f3->route('GET|POST /form1', function($f3) {
    session_start();

    if (!empty($_POST))
    if (validateForm1($f3)){

    $f3->reroute('/form2');
    }
    $template = new Template;
    echo $template->render('views/profile.html');
});

//define route for personal form
$f3->route('GET|POST /form2', function($f3) {
    session_start();
    if (validateForm2()){
        $f3->reroute('/form3');
    }

    $template = new Template;
    echo $template->render('views/personal.html');
});

//define route for interests form
$f3->route('GET|POST /form3', function($f3) {
    session_start();
    if(validateForm3()) {
        $f3->reroute('/profile');
    }

    $template = new Template;
    echo $template->render('views/interests.html');
});

//define route for profile summary
$f3->route('GET|POST /profile', function($f3) {
    session_start();
    $template = new Template;
    echo $template->render('views/summary.html');
});

//run fat free
$f3->run();