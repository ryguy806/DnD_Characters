 <?php
//error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

require ("vendor/autoload.php");

session_start();

$f3 = Base::instance();

$characters=array();
$f3->set('characters', $characters);

$f3->route('GET /', function (){



    $view = new Template();
    echo $view->render('views/home.html');
});

 $f3->route('GET /creator', function ($f3){

     $database = new Database();
     $db = $database->getConnection();

     $f3->set('db', $db);

     if($_SERVER['REQUEST_METHOD'] == $_POST){
         $name = $_POST['name'];
         $race = $_POST['race'];
         $class = $_POST['class'];
         $initiative = $_POST['initiative'];

        $f3->set('name', $name);
        $f3->set('race', $race);
        $f3->set('class', $class);
        $f3->set('initiative', $initiative);

        $character = new Character($db);

        $character->setInitiative($f3->get($initiative));
        $character->create();

        array_push($f3->get('characters'), $character);

        $f3->reroute('/list');
     }

     $view = new Template();
     echo $view->render('views/character_creator.html');
 });

 $f3->route('GET /list', function ($f3){


     $view = new Template();
     echo $view->render('views/character_viewer.html');
 });

$f3->run();