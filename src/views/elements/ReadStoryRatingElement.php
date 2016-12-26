<?php

namespace VictorLi\hw3\views\elements;

use VictorLi\hw3\views\helpers as H;

class ReadStoryRatingElement extends Element {
    public function render($data) {
        //checks to see if user has clicked on a rating
        $RatingHelper = new H\RatingHelper();
        $RatingHelper->render($data);

        ?>
            Average Rating: <?php echo($data['AverageRating']);

    }
}
