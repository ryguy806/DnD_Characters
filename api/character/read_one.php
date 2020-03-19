<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../config/database.php';
include_once '../characters/Character.php';

$database = new Database();
$db = $database->getConnection();

$character = new Character($db);

$character->_name = isset($_GET['name']) ? $_GET['name'] : die();

$character->readOne();

if($character->_name != null){
    $character_arr = array(
        "name" => $character->_name,
        "race" => $character->_race,
        "class" => $character->_class,
        "initiative" => $character->_initiative
    );

    http_response_code(200);

    echo (json_encode($character_arr));
}

else{
    http_response_code(404);

    echo json_encode(array("message" => "Character does not exist."));
}