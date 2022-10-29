<?php
$uploaddir = '/var/www/html/pdf/files/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

echo '<pre>';
setlocale(LC_ALL,'en_US.UTF-8');
$ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
if ($ext != "pdf") {
    echo "Вы попытались загрузить не pdf файл";
} else {
    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
        echo "Файл корректен и был успешно загружен.\n";
    } else {
        echo "Возможная атака с помощью файловой загрузки!\n";
    }
//echo 'Некоторая отладочная информация:';
//print_r($_FILES);
}
echo "</pre>";
?>
<a href="files.php">К списку</a>
