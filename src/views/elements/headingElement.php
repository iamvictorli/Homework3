<?php

namespace VictorLi\hw3\views\elements;

class headingElement extends Element {
    public function render($data) {
        ?> <h1><?php echo($data); ?></h1>
        <?php
    }
}
