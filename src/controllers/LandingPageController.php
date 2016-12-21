<?php

namespace VictorLi\hw3\controllers;

use VictorLi\hw3 as H;

class LandingPageController extends Controller {
    public function invoke($info = []) {
        $LandingView = new H\views\LandingView();
        $LandingView->render();
    }
}
