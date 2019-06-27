<?php
//Error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload
require_once('vendor/autoload.php');

//Creates the instance of the base class
$f3 = Base::instance();

//Specified the default route
$f3->route('GET /', function ($f3) {


    $template = new Template();
    echo $template->render('views/home.html');
});

$f3->run();