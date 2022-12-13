<?php
namespace app\controllers;

use yii\web\Controller;

class AdaptiveController extends Controller {
    public function actionIndex() {
        $data = array();
        $themeStyleSheet = 'css/light_theme.css';
        if (!empty($_COOKIE['theme']) && $_COOKIE['theme'] == 'dark') {
            $themeStyleSheet = 'css/dark_theme.css';
        }
        $lang = "ru";
        if (!empty($_COOKIE['lang']) && $_COOKIE['lang'] == 'en') {
            $lang = "en";
        }
        return $this->render('index', [
            'themeStyleSheet' => $themeStyleSheet,
            'lang' => $lang,
        ]);
    }
}