<?php

namespace VictorLi\hw3\views\elements;

class highestRatedElement extends Element {
    public function render($data) {
        ?><h3>Highest Rated</h3>
        <?php
            if(empty($data)) {
                ?>
                    <p>No story found</p><br>
                <?php
            }
            else {
                ?>
                    <ol>
                <?php
                    foreach($data as $Identifer=>$Title) {
                        ?>
                            <li><a href="index.php?c=ReadStory&m=invoke&arg1=<?php echo($Identifer); ?>"><?php echo($Title); ?></a></li>
                        <?php
                    }
                ?>
                    </ol>
                <?php
            }
    }
}
