<?php

namespace VictorLi\hw3\views\elements;

//all the elements in a view are subclasses of Element
abstract class Element {
    abstract public function render($data);
}
