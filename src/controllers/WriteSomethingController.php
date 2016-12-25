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

            //After redirect the data is processed in GET and saved to database
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
                    //get all the info for adding a new story, but first filter
                    $data['Title'] = filter_var($storydata['Title'], FILTER_SANITIZE_SPECIAL_CHARS);
                    $data['Content'] = filter_var($storydata['Writing'], FILTER_SANITIZE_SPECIAL_CHARS);
                    $data['Identifier'] = filter_var($storydata['Identifier'], FILTER_SANITIZE_SPECIAL_CHARS);
                    $data['Author'] = filter_var($storydata['Author'], FILTER_SANITIZE_SPECIAL_CHARS);

                    $data['genremultiselect'] = [];
                    if(isset($storydata['Genre'])) {
                        foreach ($storydata['Genre'] as $SelectedGenre) {
                            array_push($data['genremultiselect'], $SelectedGenre);
                        }
                    }

                    //checks to see if all user data meets the character limits
                    //if it is able to, first see if there is another story with the same identifier and replace it
                    //and the save it
                    if($this->validateUserData($data)) {
                        //if findStory model
                        //then
                        //deleteStory model

                        //save story model
                    }
                    var_dump($data);

                }
                unset($_SESSION['post-data']);
            }

            $this->invoke($data);

        }
    }

    //validates all user data
    public function validateUserData(&$data) {
        $result = true;

        if(!array_key_exists('ErrorIdentifierMessage', $data)) {
            $data['ErrorIdentifierMessage'] = '';
        } else {
            $result = false;
            return $result;
        }

        $data['ErrorTitleMessage'] = '';
        $data['ErrorAuthorMessage'] = '';
        $data['ErrorContentMessage'] = '';
        $data['ErrorGenreMultiSelectMessage'] = '';

        $identifierEmpty = false;
        //checks to see if identifier is empty
        if(empty($data['Identifier'])) {
            $data['ErrorIdentifierMessage'] = 'Identifier cannot be empty';
            $result = false;
            $identifierEmpty = true;
        }

        if(strlen($data['Title']) > 75) {
            $data['ErrorTitleMessage'] = 'Title length exceeds limit of 75';
            $result = false;
        }

        if(strlen($data['Author']) > 35) {
            $data['ErrorAuthorMessage'] = 'Author length exceeds limit of 35';
            $result = false;
        }

        if(strlen($data['Content']) > 5000) {
            $data['ErrorContentMessage'] = 'Content length exceeds limit of 5000';
            $result = false;
        }

        if(empty($data['genremultiselect'])) {
            $data['ErrorGenreMultiSelectMessage'] = 'Error. Select at least one genre';
            $result = false;
        }
        return $result;
    }
}
