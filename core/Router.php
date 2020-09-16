<?php
namespace Core;

class Router {
    public static function route ($url) {

        // get rid of /blah-blah-blah/
        array_shift($url);

        // controller
        if(isset($url[0]) && is_dir('app' . DS . 'controllers' . DS . $url[0])) {
            $dir = array_shift($url);
        }
        $controller = (isset($url[0]) && $url[0] != '') ? ucwords($url[0]) . 'Controller': DEFAULT_CONTROLLER. 'Controller';
        $controller_name = (isset($url[0]) && $url[0] != '') ? ucwords($url[0]): DEFAULT_CONTROLLER;;
        array_shift($url);

        // action
        $action = (isset($url[0]) && $url[0] != '') ? $url[0]: 'index';
        $action_name = $action;
        array_shift($url);

        // params
        $queryParams = $url;

        if(isset($dir)) {
            $controller = "App\Controllers\\{$dir}\\" . $controller;
        } else {
            $controller = 'App\Controllers\\' . $controller;
        }

        $dispatch = new $controller($controller, $action);

        if(method_exists($controller, $action)) {
            call_user_func_array([$dispatch, $action], $queryParams);
        } else {
            die("Method {$action} does not exist in the {$controller_name}");
        }
    }

    public static function redirect($location) {
        if(!headers_sent()) {
            header('Location: '.GROOT.$location);
            exit();
        } else {
            echo '<script type="text/javascript">';
            echo 'window.location.href="'.GROOT.$location.'";';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="0;url='.$location.'" />';
            echo '</noscript>';exit;
        }
    }

}
