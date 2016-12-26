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
    $LandingViewcontroller = new C\LandingPageController();
    $LandingViewcontroller->invoke();
}
else {
    if($_REQUEST['c'] === 'WriteSomethingLink' && $_REQUEST['m'] === 'invoke' || isset($_REQUEST['Reset'])) {
        $WriteSomethingController = new C\WriteSomethingController();
        $WriteSomethingController->invoke();
    } else if($_REQUEST['c'] === 'LandingView') {
        $LandingViewcontroller = new C\LandingPageController();
        $LandingViewcontroller->invoke();
    } else if($_REQUEST['c'] === 'WriteSomething' && $_REQUEST['m'] === 'processForm') {
        $WriteSomethingController = new C\WriteSomethingController();
        $WriteSomethingController->processForm();
    } else if($_REQUEST['c'] === 'ReadStory' && $_REQUEST['m'] === 'invoke') {
        $ReadStoryController = new C\ReadStoryController();
        $ReadStoryController->invoke($_REQUEST);
    } else if($_REQUEST['c'] === 'ReadStory' && $_REQUEST['m'] === 'rateStory') {
        $ReadStoryController = new C\ReadStoryController();
        $ReadStoryController->rateStory($_REQUEST);
    } else {
        echo('Page not found! Invalid Controller or method call');
    }
}
