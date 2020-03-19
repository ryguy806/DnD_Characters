<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/core.php';
include_once '../config/database.php';
include_once '../characters/Character.php';

$database = new Database();
$db = $database->getConnection();

$character = new Character($db);

$keywords = isset($_GET['s']) ? $_GET['s'] : "";

$stmt = $character->search($keywords);
$num = $stmt->rowCount();

if($num > 0){
    $character_arr = array();
    $character_arr['records'] = array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $character_item = array(
            "name" => $name,
            "race" => $race,
            "class" => $class,
            "initiative" => $initiative
        );

        array_push($character_arr['records'], $character_item);
    }

    http_response_code(200);
    echo json_encode($character_arr);
}

else{
    http_response_code(404);

    echo json_encode(array("message" => "No products found."));
}