<?php
require_once 'ProductFactory.php';
require_once 'Database.php';


function insertProduct($product) {
    $pdo = Database::getInstance()->getConnection();

    $sql = "INSERT INTO products (name, price, type) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $product->name,
        $product->price,
        $product->type
    ]);
}


$product1 = ProductFactory::create("simple",  "Livre", 20);
$product2 = ProductFactory::create("digital", "Ebook", 10);
$product3 = ProductFactory::create("service", "Formation PHP", 150);


insertProduct($product1);
insertProduct($product2);
insertProduct($product3);


echo " Produits insérés avec succès !<br><br>";
echo "<pre>";
print_r($product1);
print_r($product2);
print_r($product3);
echo "</pre>";
?>