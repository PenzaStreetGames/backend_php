<?php

class PdfController extends Controller {
    private PdfModel $pdfModel;

    public function __construct()
    {
        parent::__construct();
        $this->pdfModel = new PdfModel();
    }

    public function index() {
        $data = array();
        $data["files"] = $this->pdfModel->getFiles();
        $this->view->generate('PdfListView.php', $data);
    }

    public function upload() {
        $data = array();
        $data["uploadResult"] = $this->pdfModel->uploadFile();
        $this->view->generate('PdfUploadView.php', $data);
    }
}