<?php

header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../config/database.php";
include_once "../objects/student.php";

$database = new Database();
$db = $database->getConnection();

$student = new Student($db);

$query_result = $student->read();

$result = array("results" => array());
foreach ($query_result as $student) {
    $students_obj = array(
        "id" => $student["id"],
        "name" => $student["name"],
        "surname" => $student["surname"]
    );
    $result["results"][] = $students_obj;
}

http_response_code(200);
echo json_encode($result);