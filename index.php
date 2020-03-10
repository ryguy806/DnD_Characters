<?php
//error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

require ("vendor/autoload.php");

session_start();

$f3 = Base::instance();

$characters=array();

$f3->route('GET /', function (){
    $view = new Template();
    echo $view->render('views/home.html');
});

$f3->run();