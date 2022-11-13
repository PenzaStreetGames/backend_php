<?php

header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../config/database.php";
include_once "../objects/course.php";

$database = new Database();
$db = $database->getConnection();

$course = new Course($db);

$query_result = $course->read();

$result = array("results" => array());
foreach ($query_result as $course) {
    $courses_obj = array(
        "id" => $course["id"],
        "name" => $course["name"],
        "description" => $course["description"]
    );
    $result["results"][] = $courses_obj;
}

http_response_code(200);
echo json_encode($result);