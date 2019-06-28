<?php
//Error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

//Require the autoload
require_once('vendor/autoload.php');

//Creates the instance of the base class
$f3 = Base::instance();

//Specified the default route
$f3->route('GET|POST /', function ($f3) {

    if(isset($_SERVER['REQUEST_METHOD'])){

        $button = $_SESSION['help'];
        if(isset($_SESSION['alone'])){
            $button = $_SESSION['alone'];
        }

        $f3->set('button', $button);

        if($button == 'alone') {
            $f3->reroute('character');
        }
        else{
            $f3->reroute('guide');
        }
    }
    $template = new Template();
    echo $template->render('views/home.html');
});

$f3->route('GET|POST /character', function ($f3) {

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $name = $_SESSION['name'];
        $race = $_SESSION['name'];
        $class = $_SESSION['name'];
        $background = $_SESSION['background'];
        $armor = $_SESSION['armor'];
        $weapon = $_SESSION['weapon'];
        $shield = $_SESSION['shield'];



        $f3->reroute('start');
    }
    $template = new Template();
    echo $template->render('views/beginning.html');
});

$f3->route('GET|POST /guide', function ($f3) {

    $template = new Template();
    echo $template->render();
});

$f3->run();