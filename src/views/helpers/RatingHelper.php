<?php

namespace VictorLi\hw3\views\helpers;

class RatingHelper extends Helper {
    public function render($data) {
        //user has rated this story
        if(isset($data['showuserrating'])) {
            for($i = 1; $i <= 5; $i++) {
                if($i == $data['showuserrating']){ ?> <b><?php echo($i); ?></b> <?php }
                else { echo($i . " ");}
            }
        } else { //if user has not rated this story
            ?>
            Your Rating:
            <?php
            for($i = 1; $i <= 5; $i++) {
                ?>
                    |<a href="index.php?c=ReadStory&m=rateStory&arg1=<?php echo($data['Identifier']); ?>&arg2=<?php echo($i); ?>"><?php echo($i); ?></a>
                <?php
            }
        }
    }
}
