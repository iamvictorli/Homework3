<?php

namespace VictorLi\hw3\controllers;

use VictorLi\hw3 as H;

class WriteSomethingController extends Controller {
    public function invoke($info = []) {

        //fetch all the genres from database
        $genreData = new H\models\getGenreModel();
        $result = $genreData->doQuery();

        while($row = mysqli_fetch_assoc($result)) {
            $info['selectedgenredisplay']['genre'][] = $row['GenreName'];
        }

        $info['selectedgenredisplay']['userselected'] = [];

        if(array_key_exists('genremultiselect', $info)) {
            foreach ($info['genremultiselect'] as $selectedgenrename) {
                $info['selectedgenredisplay']['userselected'][] = $selectedgenrename;
            }
        } else {
            $info['genremultiselect'] = [];
        }

        //display editted story if needed
        if(!array_key_exists('Identifier', $info)) $info['Identifier'] = '';
        if(!array_key_exists('Author', $info)) $info['Author'] = '';
        if(!array_key_exists('Title', $info)) $info['Title'] = '';
        if(!array_key_exists('Content', $info)) $info['Content'] = '';
        if(!array_key_exists('ErrorIdentifierMessage', $info)) $info['ErrorIdentifierMessage'] = '';
        if(!array_key_exists('ErrorTitleMessage', $info)) $info['ErrorTitleMessage'] = '';
        if(!array_key_exists('ErrorAuthorMessage', $info)) $info['ErrorAuthorMessage'] = '';
        if(!array_key_exists('ErrorContentMessage', $info)) $info['ErrorContentMessage'] = '';
        if(!array_key_exists('ErrorGenreMultiSelectMessage', $info)) $info['ErrorGenreMultiSelectMessage'] = '';
        
        $WritingView = new H\views\WriteSomethingView();
        $WritingView->render($info);
    }

    public function processForm() {
        $data = [];
        if(!empty($_POST)) { // if post is not empty

            $_SESSION['post-data'] = $_POST;
            header("Location: " . 'http://localhost/homework3/index.php?c=WriteSomething&m=processForm&redirected=1', true, 302); //redirect
            exit();

        } else {

            //After redirect  the data is processed in GET and saved to database
            if(isset($_SESSION['post-data'])) {
                $storydata = $_SESSION['post-data'];

                //make sure identifier length is valid
                $invalidIdentifier = false;
                $data['ErrorIdentifierMessage'] = ''; //message written when identifier exceeds character limit of 20
                if(strlen($storydata['Identifier']) > 20) {
                    $invalidIdentifier = true;
                    $data['ErrorIdentifierMessage'] = 'Identifier length exceeds limit of 20';
                }
                //if identifier already exists in database, then display its contents for editting
                //only 2 values when editting story, when using only the identifier
                if(!$invalidIdentifier && !empty($storydata['Identifier']) && count(array_filter($storydata)) == 1) {
                    //findStoryModel checks on database if there is an identifier name attached with a story
                    //if there is fetch everything about the story
                    $findStory = new H\models\findStoryModel();
                    $result = $findStory->doQuery($storydata);

                    //if identifier is found
                    if($result->num_rows > 0) {
                        //fetch existing story
                        $fetchExistingStory = new H\models\fetchExistingStoryModel();
                        $result = $fetchExistingStory->doQuery($storydata);

                        $row = $result->fetch_assoc();
                        $data['Title'] = $row['Title'];
                        $data['Content'] = $row['Content'];
                        $data['Author'] = $row['Author'];
                        $data['Identifier'] = $storydata['Identifier'];

                        $getMultiSelectGenre = new H\models\getMultiSelectGenreModel();
                        $result = $getMultiSelectGenre->doQuery($storydata);

                        while($row=$result->fetch_assoc()) {
                            $data['genremultiselect'][] = $row['GenreName'];
                        }
                    }
                } else {
                    echo('Something is not working');
                }
                unset($_SESSION['post-data']);
            }

            $this->invoke($data);

        }
    }
}
