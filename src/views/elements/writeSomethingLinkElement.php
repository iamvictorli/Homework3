<?php

namespace VictorLi\hw3\views\elements;

class writeSomethingLinkElement extends Element {
    public function render($data) {
        ?>
        <a href="index.php?c=WriteSomethingController&m=invoke"><?php echo($data) ?></a>
        <?php
    }
}
