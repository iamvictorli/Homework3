<?php

namespace VictorLi\hw3\views\helpers;

class RatingHelper extends Helper {
    public function render($data) {
        if(isset($data['showuserrating'])) {

        } else {
            ?>
            Your Rating:
            <?php
            for($i = 0; $i < 5; $i++) {
                ?>
                    |<a href="index.php?c=ReadStory&m=rateStory&arg1=<?php echo($data['Identifier']); ?>&arg2=<?php echo($i); ?>"><?php echo($i); ?></a>
                <?php
            }
        }
    }
}
