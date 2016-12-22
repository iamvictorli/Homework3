<?php

namespace VictorLi\hw3\views\helpers;

 class PopulateGenre extends Helper {
     public function render($data) {
         foreach($data['GenreName'] as $genre) {
             echo("<option value=\"" . $genre ."\">" . $genre . "</option>\n");
         }
     }
 }
