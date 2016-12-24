<?php

namespace VictorLi\hw3\views\helpers;

 class PopulateGenre extends Helper {
    public function render($data) {
        //initial landing view
        if(array_key_exists('GenreName', $data)) {
            foreach($data['GenreName'] as $genre) {
                echo("<option value=\"" . $genre ."\">" . $genre . "</option>\n");
            }
        } // blank and inital writing view
        else if(empty($data['selectedgenredisplay']['userselected'])) {
            foreach($data['selectedgenredisplay']['genre'] as $genre) {
                echo("<option value=\"" . $genre ."\">" . $genre . "</option>\n");
            }
        } else { // when editting a story
            foreach($data['selectedgenredisplay']['genre'] as $genre) {
                if(in_array($genre, $data['selectedgenredisplay']['userselected'])) {
                    echo("<option value=\"" . $genre ."\" selected=\"selected\">" . $genre . "</option>\n");
                } else {
                    echo("<option value=\"" . $genre ."\">" . $genre . "</option>\n");
                }
            }
        }
     }
 }
