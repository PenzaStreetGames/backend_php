<?php
namespace app\controllers;

use yii\web\Controller;
use app\models\FakeDataModel;
use app\models\FakePlotModel;
use app\models\WatermarkModel;

class StatisticsController extends Controller {
    private FakeDataModel $fakerDataModel;
    private FakePlotModel $fakePlotModel;
    private WatermarkModel $watermarkModel;

    function __construct($id, $module)
    {
        parent::__construct($id, $module);
        $this->fakerDataModel = new FakeDataModel();
        $this->fakePlotModel = new FakePlotModel();
        $this->watermarkModel = new WatermarkModel();
    }

    public function actionIndex() {
        $data = $this->fakerDataModel->generateData();
        $bloodTypeCount = $this->fakerDataModel->getBloodTypeCount($data);
        $dayCount = $this->fakerDataModel->getDayCount($data);
        $xy = $this->fakerDataModel->getXYTuple($data);
        $this->fakePlotModel->draw_plot_pie($dayCount);
        $this->fakePlotModel->draw_plot_bar($bloodTypeCount);
        $this->fakePlotModel->draw_plot_scatter($xy);

        $images = array("plot_pie.png", "plot_bar.png", "plot_scatter.png");
        foreach ($images as $image) {
            $this->watermarkModel->addWatermark($image);
        }
        return $this->render('index', [
            'data' => $data
        ]);
    }
}

