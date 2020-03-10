<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
include_once '../config/database.php';
include_once '../characters/Character.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$character = new Character($db);

// query products
$stmt = $character->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){

    // products array
    $character_arr=array();
    $character_arr["records"]=array();

    //fetch table rows
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        extract($row);

        $character_item=array(
            "name" => $name,
            "race" => $race,
            "class" => $class,
            "str" => $str,
            "dex" => $dex,
            "con" => $con,
            "wis" => $wis,
            "int" => $int,
            "cha" => $cha,
        );

        array_push($character_arr["records"], $character_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show products data in json format
    echo json_encode($character_arr);
}

else{

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no products found
    echo json_encode(
        array("message" => "No products found.")
    );
}

// read products
function read(){

    // select all query
    $query = "SELECT
                c.name as category_name, p.name, p.race, p.class, p.str, p.dex, p.con, p.wis, p.int, p.cha
            FROM
                " . $this->table_name . " p
                LEFT JOIN
                    categories c
                        ON p.category_id = c.id
            ORDER BY
                p.created DESC";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // execute query
    $stmt->execute();

    return $stmt;
}