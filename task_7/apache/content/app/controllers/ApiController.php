<?php
require_once "app/models/StudentsModel.php";
require_once "app/models/Database.php";

class ApiController extends Controller {
    private Database $db;
    private StudentsModel $studentsModel;

    function __construct()
    {
        parent::__construct();
        $this->db = new Database();
        $this->studentsModel = new StudentsModel($this->db->getConnection());
    }

    public function student() {
        header("Content-Type: application/json; charset=UTF-8");
        $method = $_SERVER['REQUEST_METHOD'];
        switch ($method) {
            case "GET":
                if (isset($_GET["id"])) {
                    $this->getOne();
                    break;
                }
                $this->getAll();
                break;
            case "POST":
                $this->create();
                break;
            case "PUT":
                $this->update();
                break;
            case "DELETE":
                $this->delete();
                break;
        }
    }

    private function getOne() {
        $id = $_GET["id"];
        $found = $this->studentsModel->readOne($id);
        if ($found != null) {
            $result = array(
                "id" => $found[0],
                "name" => $found[1],
                "description" => $found[2]
            );
            http_response_code(200);
            echo json_encode($result);
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "Курс с таким ID не существует"));
        }
    }

    private function getAll() {
        $query_result = $this->studentsModel->read();

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
    }

    private function create() {
        $data = json_decode(file_get_contents("php://input"));

        if (
            !empty($data->name) &&
            !empty($data->surname)
        ) {
            $student = array();
            $student["name"] = $data->name;
            $student["surname"] = $data->surname;

            $stmt = $this->studentsModel->create($student);

            if ($stmt) {
                http_response_code(201);
                echo json_encode(array("message" => "Студент добавлен"), JSON_UNESCAPED_UNICODE);
            } else {
                http_response_code(503);
                echo json_encode(array("message" => "Невозможно добавить студента"), JSON_UNESCAPED_UNICODE);
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Невозможно добавить студента: данные неполные"), JSON_UNESCAPED_UNICODE);
        }
    }

    private function update() {
        $data = json_decode(file_get_contents("php://input"));

        if (
            !empty($data->id) &&
            !empty($data->name) &&
            !empty($data->surname)
        ) {
            $student = array();
            $student["id"] = $data->id;
            $student["name"] = $data->name;
            $student["surname"] = $data->surname;

            $stmt = $this->studentsModel->update($student);

            if ($stmt) {
                http_response_code(200);
                echo json_encode(array("message" => "Данные студента обновлены"), JSON_UNESCAPED_UNICODE);
            } else {
                http_response_code(503);
                echo json_encode(array("message" => "Невозможно обновить данные студента"), JSON_UNESCAPED_UNICODE);
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Невозможно обновить данные: данные неполные"), JSON_UNESCAPED_UNICODE);
        }
    }

    private function delete() {
        if (!isset($_GET["id"])) {
            http_response_code(400);
            echo json_encode(array("message" => "Неправильный запрос: не указан ID студента"));
        } else {
            $id = $_GET["id"];
            $found = $this->studentsModel->readOne($id);
            if ($found != null) {
                $stmt = $this->studentsModel->delete($id);
                if ($stmt) {
                    http_response_code(200);
                    echo json_encode(array("message" => "Студент удалён"));
                } else {
                    http_response_code(503);
                    echo json_encode(array("message" => "Невозможно удалить студента"), JSON_UNESCAPED_UNICODE);
                }
            }
             else {
                http_response_code(404);
                echo json_encode(array("message" => "Студент с таким ID не существует"));
            }
        }
    }
}
