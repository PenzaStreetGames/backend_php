<?php
class StudentsController extends Controller {

    function __construct()
    {
        $this->model = new StudentsModel();
    }

    function index()
    {
        $this->model->
        $this->view->generate('StudentsView.php');
    }
}