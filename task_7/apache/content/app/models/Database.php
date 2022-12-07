<?php
class Database
{
    private string $host = "db";
    private string $db_name = "appDB";
    private string $username = "root";
    private string $password = "example";
    public ?mysqli $conn;

    public function getConnection(): ?mysqli
    {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        $this->conn->query("set names utf8");
        return $this->conn;
    }
}