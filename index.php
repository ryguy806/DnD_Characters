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

    if(isset($_SERVER['REQUEST_METHOD'])){

        if() {
            $f3->reroute('start');
        }
    }
    $template = new Template();
    echo $template->render('views/home.html');
});

$f3->route('GET /start', function ($f3) {

    if($_SERVER['REQUEST_METHOD'] == 'POST'){



        $f3->reroute('start');
    }
    $template = new Template();
    echo $template->render('views/beginning.html');
});

$f3->run();