<?php

namespace VictorLi\hw3\views\elements;

class peopleWritingElement extends Element {
    public function render($data) {
        ?>
        <p><?php echo($data); ?></p>
        <?php
    }
}
