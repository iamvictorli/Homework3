<?php

namespace VictorLi\hw3\controllers;

use VictorLi\hw3 as H;

class ReadStoryController extends Controller {
    public function invoke($info = []) {
        //get story from database to rate
        $getStory = new H\models\getStoryModel();
        $result = $getStory->doQuery($info);

        $data = [];
        $row = $result->fetch_assoc();
        $data['Title'] = $row['Title'];
        $data['Author'] = $row['Author'];
        $data['Content'] = $row['Content'];
        $data['AverageRating'] = $row['AverageRating'];
        $data['Identifier'] = $info['arg1'];

        //add one view count
        $upViewCount = new H\models\upViewCountModel();
        $upViewCount->doQuery($info);


    }
}
