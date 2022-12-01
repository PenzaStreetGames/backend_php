<h1>Список студентов</h1>
<ol>
    <?php
    $mysqli = new mysqli("db", "root", "example", "appDB");
    $result = $mysqli->query("SELECT * FROM student");
    foreach ($result as $row){
        echo "<li>{$row['surname']} {$row['name']}</li>";
    }
    ?>
</ol>
<a href="../../index.php">На главную</a>
<br>
<a href="admin/admin.php">Админам сюда</a>