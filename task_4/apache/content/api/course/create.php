<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Method: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../config/database.php";

include_once "../objects/course.php";

$database = new Database();
$db = $database->getConnection();
$course = new Course($db);

$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->name) &&
    !empty($data->description)
) {
    $course->name = $data->name;
    $course->description = $data->description;

    $stmt = $course->create();

    if ($stmt) {
        http_response_code(201);
        echo json_encode(array("message" => "Курс создан"), JSON_UNESCAPED_UNICODE);
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Невозможно добавить курс"), JSON_UNESCAPED_UNICODE);
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Невозможно добавить курс: данные неполные"), JSON_UNESCAPED_UNICODE);
}

