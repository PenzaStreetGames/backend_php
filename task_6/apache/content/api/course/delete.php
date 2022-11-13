<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../config/database.php";
include_once "../objects/course.php";

$database = new Database();
$db = $database->getConnection();

$course = new Course($db);

if (!isset($_GET["id"])) {
    http_response_code(400);
    echo json_encode(array("message" => "Неправильный запрос: не указан ID курса"));
} else {
    $course->id = $_GET["id"];
    $stmt = $course->delete();
    if ($stmt) {
        http_response_code(200);
        echo json_encode(array("message" => "Курс удалён"));
    } else {
        http_response_code(404);
        echo json_encode(array("message" => "Курс с таким ID не существует"));
    }
}