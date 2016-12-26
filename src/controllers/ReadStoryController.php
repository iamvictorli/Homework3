<?php

namespace VictorLi\hw3\controllers;

use VictorLi\hw3 as H;

class ReadStoryController extends Controller {
    public function invoke($info = []) {
        //get story from database to rate
        $getStory = new H\models\getStoryModel();
        $result = $getStory->doQuery($info);
        $Identifier = $info['arg1'];

        $data = [];
        $row = $result->fetch_assoc();
        $data['Title'] = $row['Title'];
        $data['Author'] = $row['Author'];
        $data['Content'] = $row['Content'];
        $data['AverageRating'] = $row['AverageRating'];
        $data['Identifier'] = $Identifier;

        //add one view count
        $upViewCount = new H\models\upViewCountModel();
        $upViewCount->doQuery($info);

        //check if story is rated and if so set appropriate values
		if(isset($_SESSION['ratedstories'][$Identifier])) {
			$this->data['showuserrating']=$_SESSION['ratedstories'][$Identifier];
		}

        $formattedData = preg_replace("/&#13;&#10;/","&#10;",$data['Content']);
        $data['paragraphchunks']=explode("&#10;&#10;",$formattedData);

        $ReadStoryView = new H\views\ReadStoryView();
        $ReadStoryView->render($data);
    }
}
