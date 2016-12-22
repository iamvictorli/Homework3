<?php

namespace VictorLi\hw3\controllers;

use VictorLi\hw3 as H;

class WriteSomethingController extends Controller {
    public function invoke($info = []) {

        //fetch all the genres from database
        $genreData = new H\models\getGenreModel();
        $result = $genreData->doQuery();
        $data = [];
        while($row = mysqli_fetch_assoc($result)) {
            $data['GenreName'][] = $row['GenreName'];
        }

        $WritingView = new H\views\WriteSomethingView();
        $WritingView->render($data);
    }
}
