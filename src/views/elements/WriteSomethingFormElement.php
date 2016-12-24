<?php

namespace VictorLi\hw3\views\elements;

use VictorLi\hw3\views\helpers as H;

class WriteSomethingFormElement extends Element {

    public function render($data = []) {
        ?>
            <form action="index.php?c=WriteSomething&m=processForm" method="post">
                <div>
                    <label for="Identifer">Identifer:</label>
                    <input type="text" id="Identifier" name="Identifier" value="<?php echo($data['Identifier']); ?>">
                    <span class="errormsg"><?php echo($data['ErrorIdentifierMessage']); ?></span>
                </div>
                <br>

                <div>
                    <label for=Title>Title:</label>
                    <input type="text" id="Title" name="Title" value="<?php echo($data['Title']); ?>">
                    <span class="errormsg"><?php echo($data['ErrorTitleMessage']); ?></span>
                </div>
                <br>

                <div>
                    <label for="Author">Author:</label>
                    <input type="text" id="Author" name="Author" value="<?php echo($data['Author']); ?>">
                    <span class="errormsg"><?php echo($data['ErrorAuthorMessage']); ?></span>
                </div>
                <br>

                <div>
                    <label for="Genre">Genre:</label>
                    <select id="Genre" name="Genre[]" multiple="multiple">
                        <?php
                            $PopulateGenre = new H\PopulateGenre();
                            $PopulateGenre->render($data);
                        ?>
                    </select>
                    <span class="errormsg"><?php echo($data['ErrorGenreMultiSelectMessage']); ?></span>
                </div>
                <br>

                <div>
                    <label for="YourWriting"></label>
                    <textarea id="YourWriting" name="Writing" rows="25" cols="100"><?php echo($data['Content']); ?></textarea>
                    <span class="errormsg"><?php echo($data['ErrorContentMessage']); ?></span>
                </div>
                <br>

                <div>
                    <button name="Reset">Reset</button>
                    <button name="Save">Save</button>
                </div>
            </form>

        <?php
    }
}
