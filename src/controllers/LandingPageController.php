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

        //hold session values if form is posted
        if(isset($_REQUEST['GoButton']) && isset($_REQUEST['PhraseFilter'])) {
            $_SESSION['PhraseFilter'] = $_REQUEST['PhraseFilter'];
            $_SESSION['genre'] = $_REQUEST['genre'];
        }

        //initial landing page will store the filtering because of the session values
        if(isset($_SESSION['PhraseFilter']) && isset($_SESSION['genre'])) {
            $info['PhraseFilter'] = $_SESSION['PhraseFilter'];
            $info['genre'] = $_SESSION['genre'];
        } else {
            $info['PhraseFilter'] = '';
            $info['genre'] = 'All Genres';
        }

        //call getHighestRatedModel do query on $info and save it on $data[highestRated]
        $highestRated = new H\models\getHighestRatedModel();
        $result = $highestRated->doQuery($info);
        $data['highestRated'] = [];
        while($row = mysqli_fetch_assoc($result)) {
            $data['highestRated'][$row['Identifier']] = $row['Title'];
        }

        //call getMostViewedModel do query on $info and save it on $data[mostViewed]
        $mostViewed = new H\models\getMostViewedModel();
        $result = $mostViewed->doQuery($info);
        $data['mostViewed'] = [];
        while($row = mysqli_fetch_assoc($result)) {
            $data['mostViewed'][$row['Identifier']] = $row['Title'];
        }

        //call getNewestModel do query on $info and save it on $data[newest]
        $newest = new H\models\getNewestModel();
        $result = $newest->doQuery($info);
        $data['newest'] = [];
        while($row = mysqli_fetch_assoc($result)) {
            $data['newest'][$row['Identifier']] = $row['Title'];
        }

        //render landing page
        $LandingView = new H\views\LandingView();
        $LandingView->render($data);
    }
}
