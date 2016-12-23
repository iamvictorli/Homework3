<?php

namespace VictorLi\hw3\views\elements;

use VictorLi\hw3\views\helpers as H;

class WriteSomethingFormElement extends Element {

    public function render($data = []) {
        ?>
            <form action="index.php?c=WriteSomething&m=processForm" method="post">
                <label for=Title>Title:</label>
                <input type="text" id="Title" name="Title">

                <label for="Author">Author:</label>
                <input type="text" id="Author" name="Author">

                <label for="Identifer">Identifer:</label>
                <input type="text" id="Identifier" name="Identifier">
                
                <br>
                <br>

                <label for="Genre"></label>
                <select id="Genre" name="Genre[]" multiple="multiple">
                    <?php
                        $PopulateGenre = new H\PopulateGenre();
                        $PopulateGenre->render($data);
                    ?>
                </select>

                <label for="YourWriting"></label>
                <textarea id="YourWriting" name="Writing" rows="3" cols="50"></textarea>

                <button name="Reset">Reset</button>
                <button name="Save">Save</button>

            </form>

        <?php
    }
}
