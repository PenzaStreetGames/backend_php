<form enctype="multipart/form-data" action="upload" method="POST">
    <div>
        <input type="hidden" name="MAX_FILE_SIZE" value="2000000"/>
        <br>
        <label class="custom-file-label" for="file_field">Отправить этот файл:</label>
        <br>
        <input class="custom-file-input" id="file_field" name="userfile" type="file"/>
    </div>
    <br>
    <input class="btn btn-primary" type="submit" value="Отправить файл"/>
</form>

<?php
$files = $data["files"];
if (count($files) <= 2) {
    echo "<h2>Нет загруженных файлов</h2>";
} else {
    echo "<h2>Загруженные файлы</h2>";
    foreach ($files as $file) {
        if ($file != "." and $file != "..") {
            echo "<div class='card'><a class='card-body' href='pdf_files/".$file."'>".$file."</a></div>";
        }
    }
}
?>