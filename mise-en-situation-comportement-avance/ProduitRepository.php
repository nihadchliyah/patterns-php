<?php
require_once '../Database.php';
require_once 'Produit.php';



class ProduitRepository {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function ajouter(Produit $produit): void {
        $stmt = $this->pdo->prepare(
            "INSERT INTO products (name, price, stock, type) VALUES (:name, :price, :stock, :type)"
        );
        $stmt->execute([
            ':name'  => $produit->getNom(),
            ':price' => $produit->getPrix(),
            ':stock' => $produit->getStock(),
            ':type'  => 'general'
        ]);
    }

    public function supprimer(int $id): void {
        $stmt = $this->pdo->prepare("DELETE FROM products WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }

    public function modifier(Produit $produit): void {
        $stmt = $this->pdo->prepare(
            "UPDATE products SET name = :name, price = :price, stock = :stock WHERE id = :id"
        );
        $stmt->execute([
            ':id'    => $produit->getId(),
            ':name'  => $produit->getNom(),
            ':price' => $produit->getPrix(),
            ':stock' => $produit->getStock()
        ]);
    }

    public function findAll(): array {
        return $this->pdo->query("SELECT * FROM products")->fetchAll(PDO::FETCH_ASSOC);
    }
  
}