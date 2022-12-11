<?php
class AdaptiveController extends Controller {
    public function index()
    {
        $data = array();
        $data["themeStyleSheet"] = 'resources/css/light_theme.css';
        if (!empty($_COOKIE['theme']) && $_COOKIE['theme'] == 'dark') {
            $data["themeStyleSheet"] = 'resources/css/dark_theme.css';
        }
        $data["lang"] = "ru";
        if (!empty($_COOKIE['lang']) && $_COOKIE['lang'] == 'en') {
            $data["lang"] = "en";
        }
        $this->view->generate("AdaptiveView.php", $data);
    }
}