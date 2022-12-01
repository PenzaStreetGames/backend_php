<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

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
    $stmt = $student->delete();
    if ($stmt) {
        http_response_code(200);
        echo json_encode(array("message" => "Студент удалён"));
    } else {
        http_response_code(404);
        echo json_encode(array("message" => "Студент с таким ID не существует"));
    }
}