<?php
require_once 'Product.php';

class ServiceProduct extends Product {
    public function getType() {
        return "service";
    }
}
?>