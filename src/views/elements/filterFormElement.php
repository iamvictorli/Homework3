<?php

namespace VictorLi\hw3\views\elements;

use VictorLi\hw3\views\helpers as H;

class filterFormElement extends Element {
    public function render($data) {
        ?>
            <form action="index.php?c=Filter&m=model" method="post">
                <input type="text" name="PhraseFilter" placeholder="Phrase Filter">
                <select name="genre">
                    <option selected="selected">All Genres</option>
                    <?php
                        $PopulateGenre = new H\PopulateGenre();
                        $PopulateGenre->render($data);
                    ?>
                </select>
                <input type="submit" value="Go">
            </form>
        <?php
    }
}
