<?php
require_once 'SimpleProduct.php';
require_once 'DigitalProduct.php';
require_once 'ServiceProduct.php';


class ProductFactory {
    public static function create($type, $name, $price) {
        switch ($type) {
            case "simple":
                return new SimpleProduct($name, $price);
            case "digital":
                return new DigitalProduct($name, $price);
            case "service":
                return new ServiceProduct($name, $price);
            default:
                throw new Exception("Type de produit inconnu : $type");
        }
    }
}
?>