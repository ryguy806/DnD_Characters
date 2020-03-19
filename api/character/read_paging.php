<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/core.php';
include_once '../config/database.php';
include_once '../characters/Character.php';

$utilities = new Utilities();

$database = new Database();
$db = $database->getConnection();

$character = new Character();

$stmt = $character->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();

if($num > 0){
    $character_arr = array();
    $charcater_arr["records"] = array();
    $character_arr["paging"] = array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $character_item = array(
            "name" => $name,
            "race" => $race,
            "str" => $str,
            "dex" => $dex,
            "con" => $con,
            "wis" => $wis,
            "int" => $int,
            "cha" => $cha,
            "initiative" => $initiative
        );

        array_push($character_arr["records"], $character_item);
    }

    $total_rows=$character->count();
    $page_url="{$home_url}character/read_paging.php?";
    $paging=$utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $products_arr["paging"]=$paging;
}

else{
    http_response_code(404);

    echo json_encode(array("message" => "No characters found."));
}
