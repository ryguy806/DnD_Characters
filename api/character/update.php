<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../characters/Character.php';

$database = new Database();
$db = $database->getConnection();

$character = new Character($db);

$data = json_decode(file_get_contents("php://input"));

$character->_name = $data->name;
$character->_race = $data->race;
$character->_class = $data->class;
$character->_str = $data->str;
$character->_dex = $data->dex;
$character->_con = $data->con;
$character->_wis = $data->wis;
$character->_int = $data->int;
$character->_cha = $data->cha;
$character->_initiative = $data->initiative;

if($character->update()){

    http_response_code(200);

    echo json_encode(array("message"=> "Character was updated!"));
}

else {
    http_response_code(503);

    echo json_encode(array("message" => "Character was unable to be updated."));
}