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

    $view = new View;
    echo $view->render('views/home.html');
});

$f3->route('GET|POST /form1', function($f3) {

    if (validateForm1()){
    $f3->set("SESSION.email", $f3->get("POST.email"));
    $f3->set("SESSION.state", $f3->get("POST.state"));
    $f3->set("SESSION.seeking", $f3->get("POST.seeking"));

    $f3->reroute('/form2');
    }
    $template = new Template;
    echo $template->render('views/profile.html');
});

$f3->route('GET|POST /form2', function($f3) {

    $template = new Template;
    echo $template->render('views/personal.html');
});

$f3->route('GET|POST /form3', function($f3) {

    $template = new Template;
    echo $template->render('views/interests.html');
});

$f3->route('GET|POST /profile', function($f3) {

    $template = new Template;
    echo $template->render('views/summary.html');
});

//run fat free
$f3->run();