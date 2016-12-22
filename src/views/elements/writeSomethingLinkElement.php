<?php

namespace VictorLi\hw3\views\elements;

class writeSomethingLinkElement extends Element {
    public function render($data) {
        ?>
        <a href="index.php?c=WriteSomethingLink&m=invoke"><?php echo($data) ?></a>
        <?php
    }
}
