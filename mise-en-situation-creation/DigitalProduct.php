<?php
require_once 'Product.php';

class DigitalProduct extends Product {
    public function getType() {
        return "digital";
    }
}
?>