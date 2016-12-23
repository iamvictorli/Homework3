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

    public function processForm() {
        if(!empty($_POST)) { // if post is not empty

            $_SESSION['post-data'] = $_POST;
            header("Location: " . 'http://localhost/homework3/index.php?c=WriteSomething&m=processForm&redirected=1', true, 302); //redirect
            exit();

        } else {

            //After redirect  the data is processed in GET and saved to database
            if(isset($_SESSION['post-data'])) {
                $storydata = $_SESSION['post-data'];

                //if identifier already exists in database, then display its contents for editting
                //also make sure identifier length is valid
                
            }

            $this->invoke();

        }
    }
}
