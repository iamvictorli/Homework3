<?php

namespace VictorLi\hw3;

use VictorLi\hw3\controllers as C;

session_start();
//class autoloader
spl_autoload_register(function ($class) {
    //project-specific namespace prefix
    $prefix = 'VictorLi\\hw3';
    $relative_class = substr($class, strlen($prefix));

    $class_name = "/".str_replace('\\', '/', $relative_class) . '.php';
    $filename = 'src' . $class_name;
    if(file_exists($filename)) {
        require_once $filename;
    }
});
//if controller and model is not set
if(!isset($_REQUEST['c']) && !isset($_REQUEST['m'])) {
    $controller = new C\LandingPageController();
    $controller->invoke();
}
else {

}
