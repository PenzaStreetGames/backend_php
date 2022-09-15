<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bash</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
          crossorigin="anonymous">

</head>
<body>
<h1>Серверная панель</h1>
<?php
function print_cmd($cmd) {
    $lines = array();
    exec($cmd, $lines);
    echo "<pre> > ".$cmd."</pre>";
    echo "<pre>".implode("\n", $lines)."</pre>";
}

$command_list = array("ls", "ps", "whoami", "id");
foreach ($command_list as $cmd) {
    print_cmd($cmd);
}
?>
</body>
</html>

