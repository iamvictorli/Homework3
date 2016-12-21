<?php

namespace VictorLi\hw3\views;

use VictorLi\hw3\views\elements as E;

class LandingView extends View {
    public function render($data = []) {
        ?>
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="utf-8">
                <title>Five Thousand Characters</title>
                <link rel="stylesheet" type="text/css" href="./src/styles/main.css">
            </head>
            <body>
                <?php

                $headingElement = new E\headingElement();
                $headingElement->render('Five Thousand Characters');

                $WriteSomethingLinkElement = new E\writeSomethingLinkElement();
                $WriteSomethingLinkElement->render('Write Something!');

                $checkPeopleWritingElement = new E\peopleWritingElement();
                $checkPeopleWritingElement->render('Check out what people are writing...');

                $filterForm = new E\filterFormElement();
                $filterForm->render($data);


                ?>
            </body>
        </html>
        <?php
    }
}
