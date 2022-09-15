<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quicksort</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<h1>Сортировка массива</h1>
<?php

function quick_sort($array) {
    if (count($array) < 2) {
        return $array;
    }
    $target = $array[0];
    $less = array(); $equal = array($target); $greater = array();
    for ($i = 1; $i < count($array); $i++) {
        $elem = $array[$i];
        if ($elem > $target) {
            $greater[] = $elem;
        } elseif ($elem < $target) {
            $less[] = $elem;
        } else {
            $equal[] = $elem;
        }
    }
    $less = quick_sort($less);
    $greater = quick_sort($greater);
    return array_merge($less, $equal, $greater);
}

function print_array($array): void {
    echo "<pre>[";
    echo implode(", ", $array);
    echo "]</pre>";
}

if (isset($_GET['array'])) {
    $array = explode(",", $_GET["array"]);
    echo "<p>Считанный массив</p>";
    print_array($array);
    $array = quick_sort($array);
    echo "<p>Отсортированный массив</p>";
    print_array($array);
} else {
    echo "<p>Задайте числа, разделённые запятыми в параметре array, чтобы отсортировать их</p>
<pre>
    http:localhost:8080/sort.php?array=4,2,5,...
</pre>";
}
?>
</body>
</html>

