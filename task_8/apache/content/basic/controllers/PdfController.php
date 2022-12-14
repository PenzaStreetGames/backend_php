<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\PdfModel;
use yii\web\UploadedFile;

class PdfController extends Controller
{
    public function actionIndex() {
        $model = new PdfModel();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
            }
        }
        $files = scandir('/var/www/html/basic/web/uploads');
        $files = array_filter($files, static function ($item) { return $item != "." and $item != ".."; });
        return $this->render(
            'index', ['model' => $model, 'files' => $files]
        );
    }

    public function getFiles(): bool|array
    {

        # $files = array_filter($files, static function ($item) { return $item != "." and $item != ".."; });
        return $files;
    }

    public function actionUpload()
    {
        $model = new PdfModel();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
                return;
            }
        }

        return $this->render('index', ['model' => $model]);
    }
}