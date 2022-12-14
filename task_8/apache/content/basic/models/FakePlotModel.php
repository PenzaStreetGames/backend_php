<?php
namespace app\models;

use Amenadiel\JpGraph\Graph;
use Amenadiel\JpGraph\Plot;

class FakePlotModel {
    static $imageFolder = "/var/www/html/basic/web/images";

    function draw_plot_bar($bloodTypeCount)
    {
        $__width = 400;
        $__height = 300;
        $graph = new Graph\Graph($__width, $__height, 'auto');
        $graph->SetShadow();
        $graph->title->Set("Blood Type");
        $graph->title->SetFont(FF_FONT1, FS_BOLD);

        $labels_and_values = $bloodTypeCount;
        $labels = $labels_and_values["labels"];
        $values = $labels_and_values["values"];

        $databary = $values;
        $graph->SetScale('textlin');
        $graph->xaxis->SetTickLabels($labels);
        $b1 = new Plot\BarPlot($databary);
        $graph->Add($b1);
        $graph->Stroke(self::$imageFolder.'/plot_bar.png');
    }

    function draw_plot_pie($dayCount)
    {
        $graph = new Graph\PieGraph(400, 300);
        $graph->title->Set("Day choice");
        $graph->title->SetFont(FF_FONT1, FS_BOLD);
        $graph->SetBox(true);

        $labels_and_values = $dayCount;
        $labels = $labels_and_values["labels"];
        $values = $labels_and_values["values"];

        $p1 = new Plot\PiePlot($values);
        $p1->ShowBorder();
        $p1->SetColor('black');
        $p1->SetLabels($labels);
        $graph->Add($p1);
        $graph->Stroke(self::$imageFolder.'/plot_pie.png');
    }

    function draw_plot_scatter($dayBloodTuple)
    {
        $data = $dayBloodTuple;
        $datax = $data["x"];
        $datay = $data["y"];

        $__width = 400;
        $__height = 300;
        $graph = new Graph\Graph($__width, $__height);
        $graph->SetScale('linlin');

        $graph->img->SetMargin(40, 40, 40, 40);
        $graph->SetShadow();

        $graph->title->Set('Blood and Day');
        $graph->title->SetFont(FF_FONT1, FS_BOLD);


        $sp1 = new Plot\ScatterPlot($datay, $datax);
        $sp1->mark->SetType(MARK_FILLEDCIRCLE);
        $sp1->mark->SetFillColor("#ff8800");
        $sp1->mark->SetWidth(8);

        $graph->Add($sp1);
        $graph->Stroke(self::$imageFolder.'/plot_scatter.png');
    }
}