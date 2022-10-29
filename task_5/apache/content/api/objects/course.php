<?php

class Course {
    private ?mysqli $conn;
    private string $table_name = "course";

    public int $id;
    public ?string $name;
    public ?string $description;

    public function __construct($db) {
        $this->conn = $db;
    }

    function read() {
        $query = "
        SELECT s.id, s.name, s.description FROM course AS s
        ORDER BY s.id; 
        ";

        $stmt = $this->conn->query($query);
        return $stmt;
    }

    function create() {
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));

        $query = "INSERT INTO course(name, description) VALUE ('".$this->name."', '".$this->description."');";

        $stmt = $this->conn->query($query);
        $this->conn->commit();
        return $stmt;
    }

    function readOne() {
        $query = "SELECT s.id, s.name, s.description FROM course AS s WHERE s.id = ".$this->id.";";
        $result = $this->conn->query($query)->fetch_row();
        return $result;
    }

    function update() {
        $query = "
            UPDATE course 
            SET name = '".$this->name."', description = '".$this->description."' 
            WHERE id = ".$this->id.";
            ";
        $stmt = $this->conn->query($query);
        $this->conn->commit();
        return $stmt;
    }

    function delete() {
        $query = "DELETE FROM course WHERE id = ".$this->id.";";
        $stmt = $this->conn->query($query);
        $this->conn->commit();
        return $stmt;
    }
}