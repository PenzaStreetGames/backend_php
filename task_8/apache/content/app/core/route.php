<?php
class Route
{
    static function start()
    {
        $controller_name = 'Main';
        $action_name = 'index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if ( !empty($routes[1]) )
        {

            $controller_name = ucfirst($routes[1]);
        }

        if ( !empty($routes[2]) )
        {
            $routes[2] = explode('?', $routes[2])[0];
            $action_name = $routes[2];
        }

        $model_name = $controller_name.'Model';
        $controller_name = $controller_name.'Controller';

        $model_file = strtolower($model_name).'.php';
        $model_path = "app/models/".$model_file;
        if(file_exists($model_path))
        {
            include "app/models/".$model_file;
        }
        $controller_file = strtolower($controller_name).'.php';
        $controller_path = "app/controllers/".$controller_file;
        if(file_exists($controller_path))
        {
            include "app/controllers/".$controller_file;
        }
        else
        {
            Route::ErrorPage404();
        }

        $controller = new $controller_name;
        $action = $action_name;

        if(method_exists($controller, $action))
        {
            $controller->$action();
        }
        else
        {
            Route::ErrorPage404();
        }
    }

    static function ErrorPage404()
    {
        header("NotFoundPage: ".$_SERVER['REQUEST_URI']);
        $host = 'http://localhost:8080/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'NotFound');
    }
}