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
         $str = $_POST['str'];
         $dex = $_POST['dex'];
         $con = $_POST['con'];
         $wis = $_POST['wis'];
         $int = $_POST['int'];
         $cha = $_POST['cha'];
         $initiative = $_POST['initiative'];

        $f3->set('name', $name);
        $f3->set('race', $race);
        $f3->set('class', $class);
        $f3->set('str', $str);
        $f3->set('dex', $dex);
        $f3->set('con', $con);
        $f3->set('wis', $wis);
        $f3->set('int', $int);
        $f3->set('cha', $cha);
        $f3->set('initiative', $initiative);

        $character = new Character($db, $f3->get('name'), $f3->get('race'), $f3->get('class'), $f3->get('str'),
            $f3->get('dex'), $f3->get('con'), $f3->get('wis'), $f3->get('int'), $f3->get('cha'));

        $character->setInitiative($f3->get($initiative));
        $character->create();

        array_push($f3->get('characters'), $character);

        $f3->reroute();
     }

     $view = new Template();
     echo $view->render('views/character_creator.html');
 });

 $f3->route('GET /list', function (){



     $view = new Template();
     echo $view->render('views/character_viewer.html');
 });

$f3->run();