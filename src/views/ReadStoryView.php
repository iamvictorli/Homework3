<?php

namespace VictorLi\hw3\views;

use VictorLi\hw3\views\elements as E;

class ReadStoryView extends View {
    public function render($data = []) {
        ?>
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="utf-8">
                <title>Five Thousand Characters - <?php echo($data['Title']); ?></title>
                <link rel="stylesheet" type="text/css" href="./src/styles/main.css">
            </head>
            <body>
                <?php
                    $heading = new E\headingElement();
                    $heading->render('<a href="index.php?c=LandingView&m=model">Five Thousand Characters</a> - ' . $data['Title']);

                    $ReadStoryDisplay = new E\ReadStoryDisplayElement();
                    $ReadStoryDisplay->render($data);

                    $ReadStoryRating = new E\ReadStoryRatingElement();
                    $ReadStoryRating->render($data);
                ?>
            </body>
        </html>
        <?php
    }
}
