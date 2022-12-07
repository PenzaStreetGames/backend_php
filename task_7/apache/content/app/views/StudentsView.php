<h1>Список студентов</h1>
<ol>
    <?php
    foreach ($data as $row){
        echo "<li>{$row['surname']} {$row['name']}</li>";
    }
    ?>
</ol>
<a href="../../index.php">На главную</a>
<br>
<a href="../../admin/AdminView.php">Админам сюда</a>