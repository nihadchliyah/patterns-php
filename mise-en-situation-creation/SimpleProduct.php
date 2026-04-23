<?php
require_once 'Product.php';

class SimpleProduct extends Product {
    public function getType() {
        return "simple";
    }
}
?>