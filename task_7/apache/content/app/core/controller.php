<?php
class Controller {

    public $model;
    public $view;

    function __construct()
    {
        $this->view = new View();
        $this->model = new Model();
    }

    function index()
    {
    }
}