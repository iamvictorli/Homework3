<?php

namespace VictorLi\hw3\views;

use VictorLi\hw3\views\elements as E;

class WriteSomethingView extends View {

    public function render($data = []) {
        ?>
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="utf-8">
                <title>Five Thousand Characters - Write Something</title>
                <link rel="stylesheet" type="text/css" href="src/styles/main.css">
            </head>
            </body>
                <?php
                    $heading = new E\headingElement();
                    $heading->render('<a href="index.php?c=LandingView&m=model">Five Thousand Characters</a> - Write Something');

                    $WriteSomethingForm = new E\WriteSomethingFormElement();
                    $WriteSomethingForm->render($data);
                ?>
            </body>
        </html>
        <?php
    }
}
