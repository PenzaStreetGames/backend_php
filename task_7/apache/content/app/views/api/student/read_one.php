<?php

header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Credentials: true");

include_once "../config/database.php";
include_once "../objects/student.php";

$database = new Database();
$db = $database->getConnection();

$student = new Student($db);

if (!isset($_GET["id"])) {
    http_response_code(400);
    echo json_encode(array("message" => "Неправильный запрос: не указан ID студента"));
} else {
    $student->id = $_GET["id"];
    $found = $student->readOne();
    if ($found != null) {
        $result = array(
            "id" => $found[0],
            "name" => $found[1],
            "surname" => $found[2]
        );
        http_response_code(200);
        echo json_encode($result);
    } else {
        http_response_code(404);
        echo json_encode(array("message" => "Студент с таким ID не существует"));
    }
}
