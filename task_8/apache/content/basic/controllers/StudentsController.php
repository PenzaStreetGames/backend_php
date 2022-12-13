<?php
namespace app\controllers;

use yii\rest\ActiveController;

class StudentsController extends ActiveController
{
    public $modelClass = 'app\models\Student';
}