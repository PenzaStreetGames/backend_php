<?php
class AdminController extends Controller {
    public function index()
    {
        $this->view->generate("admin/AdminView.php", array());
    }
}
