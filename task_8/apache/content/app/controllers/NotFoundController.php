<?php
class NotFoundController extends Controller {
    public function index() {
        $this->view->generate("NotFoundView.php", array());
    }
}