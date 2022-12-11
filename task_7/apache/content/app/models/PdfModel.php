<?php
class PdfModel extends Model {
    public function getFiles(): bool|array
    {
        $files = scandir('resources/pdf_files');
        # $files = array_filter($files, static function ($item) { return $item != "." and $item != ".."; });
        return $files;
    }

    public function uploadFile(): string
    {
        $uploaddir = 'resources/pdf_files/';
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

        setlocale(LC_ALL, 'en_US.UTF-8');
        $ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
        if ($ext != "pdf") {
            return "Вы попытались загрузить не pdf файл";
        } else {
            if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
                return "Файл корректен и был успешно загружен.\n";
            } else {
                return "Возможная атака с помощью файловой загрузки!\n";
            }
        }
    }
}
