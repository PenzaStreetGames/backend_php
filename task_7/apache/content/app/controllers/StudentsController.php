<?php
require_once "app/models/StudentsModel.php";
require_once "app/models/Database.php";

class StudentsController extends Controller
{
    private Database $db;

    function __construct()
    {
        parent::__construct();
        $this->db = new Database();
        $this->model = new StudentsModel($this->db->getConnection());
    }

    function index()
    {
        $data = $this->model->read();
        $this->view->generate('StudentsView.php', $data);
    }
}