<?php

namespace VictorLi\hw3\controllers;

use VictorLi\hw3 as H;

class LandingPageController extends Controller {
    public function invoke($info = []) {

        //fetch all the genres from database
        $genreData = new H\models\getGenreModel();
        $result = $genreData->doQuery();
        $data = [];
        while($row = mysqli_fetch_assoc($result)) {
            $data['GenreName'][] = $row['GenreName'];
        }

        //render landing page
        $LandingView = new H\views\LandingView();
        $LandingView->render($data);
    }
}
