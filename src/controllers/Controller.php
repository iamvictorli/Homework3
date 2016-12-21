<?php
namespace VictorLi\hw3\controllers;

abstract class Controller {
    abstract public function invoke($info = []);
}
