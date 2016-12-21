<?php

namespace VictorLi\hw3\models;

abstract class Model {
    abstract public function doQuery($data = []);
}
