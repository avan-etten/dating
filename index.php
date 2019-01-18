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

//Create an instance of the Base class
$f3 = Base::instance();

//define a default route
$f3->route('GET /', function() {
    //echo "<h1>Hello, world!</h1>";
    $view = new View;
    echo $view->render('views/home.html');
});

//run fat free
$f3->run();