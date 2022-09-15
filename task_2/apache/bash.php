<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bash</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
<h1>Серверная консоль</h1>
<?php
if (isset($_GET["cmd"])) {
    $cmd = $_GET["cmd"];
    $command_list = array("ls", "ps", "whoami", "id");
    $output = array();
    if (in_array($cmd, $command_list)) {
        $message = exec($cmd, $output);
    } else {
        $message = "forbidden command ".$cmd;
        $output[] = $message;
    }
    echo "<p>Команда: <pre>".$cmd."</pre></p>";
    echo "<pre>".implode("<br>", $output)."</pre>";
} else {
    echo "<p>Задайте название команды в параметре cmd</p>
<pre>
    http:localhost:8080/bash.php?cmd=ls
</pre>";
}
?>
</body>
</html>

