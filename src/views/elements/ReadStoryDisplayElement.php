<?php

namespace VictorLi\hw3\views\elements;

use VictorLi\hw3\views\helpers as H;

class ReadStoryDisplayElement extends Element {
    public function render($data) {
        ?>
            <div><p>Author - <?php echo($data['Author']); ?></p></div>
            <div>
                <p>Content:</p>
                    <?php
                        foreach ($data['paragraphchunks'] as $paragraphchunks) {
                            echo('<p>' . $paragraphchunks . '</p>');
                        }

                    ?>
            </div>
        <?php

    }
}
