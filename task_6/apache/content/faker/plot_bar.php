<?php

/**
 * JPGraph v4.0.3
 */

require_once '../vendor/autoload.php';

use Amenadiel\JpGraph\Graph;
use Amenadiel\JpGraph\Plot;

require_once 'data_load.php';

function draw_plot_bar()
{
// new Graph\Graph with a drop shadow
    $__width = 400;
    $__height = 300;
    $graph = new Graph\Graph($__width, $__height, 'auto');
    $graph->SetShadow();
    $graph->title->Set("Blood Type");
    $graph->title->SetFont(FF_FONT1, FS_BOLD);


    $labels_and_values = get_labels_and_values('get_blood_type_count');
    $labels = $labels_and_values["labels"];
    $values = $labels_and_values["values"];

// Some data
    $databary = $values;

// Use a "text" X-scale
    $graph->SetScale('textlin');

// Specify X-labels
    $graph->xaxis->SetTickLabels($labels);

// Set title and subtitle
    $graph->title->Set($_GET['property']);

// Use built in font
    $graph->title->SetFont(FF_FONT1, FS_BOLD);

// Create the bar plot
    $b1 = new Plot\BarPlot($databary);
    $b1->SetLegend($_GET['property']);

//$b1->SetAbsWidth(6);
//$b1->SetShadow();

// The order the plots are added determines who's ontop
    $graph->Add($b1);

// Finally output the  image
// imagepng($graph->img->img);
    $graph->Stroke('images/plot_bar.png');
}