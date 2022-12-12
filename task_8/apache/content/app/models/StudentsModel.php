<?php
class StudentsModel extends Model {
    public function getStudentList() {
        $mysqli = new mysqli("db", "root", "example", "appDB");
        return $mysqli->query("SELECT * FROM student");
    }
    private ?mysqli $conn;
    private string $table_name = "course";

    public int $id;
    public ?string $name;
    public ?string $surname;

    public function __construct($db) {
        $this->conn = $db;
    }

    function read() {
        $query = "
        SELECT s.id, s.name, s.surname FROM student AS s
        ORDER BY s.id; 
        ";

        $stmt = $this->conn->query($query);
        return $stmt;
    }

    function create($entity) {
        $query = "INSERT INTO student(name, surname) VALUE ('".$entity['name']."', '".$entity['surname']."');";

        $stmt = $this->conn->query($query);
        $this->conn->commit();
        return $stmt;
    }

    function readOne($id) {
        $query = "SELECT s.id, s.name, s.surname FROM student AS s WHERE s.id = ".$id.";";
        $result = $this->conn->query($query)->fetch_row();
        return $result;
    }

    function update($entity) {
        $query = "
            UPDATE student 
            SET name = '".$entity['name']."', surname = '".$entity['surname']."' 
            WHERE id = ".$entity['id'].";
            ";
        $stmt = $this->conn->query($query);
        $this->conn->commit();
        return $stmt;
    }

    function delete($id) {
        $query = "DELETE FROM student WHERE id = ".$id.";";
        $stmt = $this->conn->query($query);
        $this->conn->commit();
        return $stmt;
    }
}