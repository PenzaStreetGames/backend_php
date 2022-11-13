<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Кафедра ПМ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
          crossorigin="anonymous">
</head>
<body>
<?php
require_once "faker.php";

generate_data();
?>
<?php
require_once "plot_bar.php";
require_once "plot_pie.php";
require_once "plot_scatter.php";

draw_plot_pie();
draw_plot_bar();
draw_plot_scatter();
?>
<?php
require_once "watermark.php";

$images = array("images/plot_pie.png", "images/plot_bar.png", "images/plot_scatter.png");

foreach ($images as $image) {
    add_watermark($image);
}
?>
<img src="images/plot_pie.png" alt="plot_1.png">
<img src="images/plot_bar.png" alt="plot_2.png">
<img src="images/plot_scatter.png" alt="plot_3.png">

<table class="table">
    <tr>
        <th>Name</th>
        <th>Color</th>
        <th>Month</th>
        <th>Emoji</th>
        <th>Blood Type</th>
        <th>Weekday</th>
    </tr>
    <?php
    $data = get_raw_data();

    foreach ($data as $data_row) {
        echo "<tr>";
        echo "<td>".$data_row->name."</td>";
        echo "<td>".$data_row->color."</td>";
        echo "<td>".$data_row->month."</td>";
        echo "<td>".$data_row->emoji."</td>";
        echo "<td>".$data_row->bloodType."</td>";
        echo "<td>".$data_row->weekday."</td>";
        echo "</tr>";
    }
    ?>
</table>
</body>
</html>
