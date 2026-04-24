<?php

require_once __DIR__ . '/../src/Service/ProductService.php';

$service = new ProductService();

// ── Ajouter trois produits ──────────────────────────────────────────────────
echo nl2br("\n=== Ajout de produits ===\n");

$service->addProduct(new ProductDTO(null, "Laptop",             1299.99, 10));
echo nl2br("Produit 'Laptop' ajouté avec succès.\n");

$service->addProduct(new ProductDTO(null, "Souris",               29.99, 50));
echo nl2br("Produit 'Souris' ajouté avec succès.\n");

$service->addProduct(new ProductDTO(null, "Clavier mécanique",    89.90, 25));
echo nl2br("Produit 'Clavier mécanique' ajouté avec succès.\n");

// ── Lister tous les produits ────────────────────────────────────────────────
echo nl2br("\n=== Liste des produits ===\n");

foreach ($service->getAllProducts() as $dto) {
    echo nl2br(sprintf(
        "  [%d] %-25s prix : %.2f€   stock : %d\n",
        $dto->id, $dto->nom, $dto->prix, $dto->stock
    ));
}

// ── Modifier le premier produit ─────────────────────────────────────────────
$all     = $service->getAllProducts();
$firstId = $all[0]->id;

echo nl2br("\n=== Modification du produit id=$firstId ===\n");

$service->updateProduct($firstId, new ProductDTO(null, "Laptop Pro", 1499.99, 8));
$updated = $service->getProduct($firstId);

echo nl2br(sprintf(
    "  Mis à jour → [%d] %s  prix : %.2f€   stock : %d\n",
    $updated->id, $updated->nom, $updated->prix, $updated->stock
));

// ── Supprimer le dernier produit ────────────────────────────────────────────
$lastId = end($all)->id;

echo nl2br("\n=== Suppression du produit id=$lastId ===\n");

$service->deleteProduct($lastId);
echo nl2br("  Produit id=$lastId supprimé avec succès.\n");

// ── Liste finale ─────────────────────────────────────────────────────────────
echo nl2br("\n=== Liste finale ===\n");

foreach ($service->getAllProducts() as $dto) {
    echo nl2br(sprintf(
        "  [%d] %-25s prix : %.2f€   stock : %d\n",
        $dto->id, $dto->nom, $dto->prix, $dto->stock
    ));
}
