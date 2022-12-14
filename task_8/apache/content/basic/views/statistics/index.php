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
        <th>X</th>
        <th>Y</th>
    </tr>
    <?php
    foreach ($data as $data_row) {
        echo "<tr>";
        echo "<td>".$data_row->name."</td>";
        echo "<td>".$data_row->color."</td>";
        echo "<td>".$data_row->month."</td>";
        echo "<td>".$data_row->emoji."</td>";
        echo "<td>".$data_row->bloodType."</td>";
        echo "<td>".$data_row->weekday."</td>";
        echo "<td>".$data_row->random_x."</td>";
        echo "<td>".$data_row->random_y."</td>";
        echo "</tr>";
    }
    ?>
</table>
