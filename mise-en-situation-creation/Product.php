<?php

abstract class Product {
    public $name;
    public $price;
    public $type;

    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
        $this->type = $this->getType();
    }

    abstract public function getType();
}
?>