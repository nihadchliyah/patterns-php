<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../Entity/Product.php';

class ProductRepository {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
        $this->createTableIfNotExists();
    }

    private function createTableIfNotExists(): void {
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS produits (
                id    INT AUTO_INCREMENT PRIMARY KEY,
                nom   VARCHAR(255)   NOT NULL,
                prix  DECIMAL(10,2)  NOT NULL,
                stock INT            NOT NULL
            )
        ");
    }

    public function findAll(): array {
        $stmt = $this->pdo->query("SELECT * FROM produits");
        $rows = $stmt->fetchAll();

        return array_map(fn($row) => $this->hydrate($row), $rows);
    }

    public function findById(int $id): ?Product {
        $stmt = $this->pdo->prepare("SELECT * FROM produits WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();

        return $row ? $this->hydrate($row) : null;
    }

    public function save(Product $product): void {
        $stmt = $this->pdo->prepare(
            "INSERT INTO produits (nom, prix, stock) VALUES (:nom, :prix, :stock)"
        );
        $stmt->execute([
            ':nom'   => $product->getNom(),
            ':prix'  => $product->getPrix(),
            ':stock' => $product->getStock(),
        ]);
    }

    public function update(Product $product): void {
        $stmt = $this->pdo->prepare(
            "UPDATE produits SET nom = :nom, prix = :prix, stock = :stock WHERE id = :id"
        );
        $stmt->execute([
            ':id'    => $product->getId(),
            ':nom'   => $product->getNom(),
            ':prix'  => $product->getPrix(),
            ':stock' => $product->getStock(),
        ]);
    }

    public function delete(int $id): void {
        $stmt = $this->pdo->prepare("DELETE FROM produits WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }

    private function hydrate(array $row): Product {
        return new Product(
            (int)  $row['id'],
                   $row['nom'],
            (float)$row['prix'],
            (int)  $row['stock']
        );
    }
}
