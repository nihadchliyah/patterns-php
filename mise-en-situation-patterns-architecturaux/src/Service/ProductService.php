<?php

require_once __DIR__ . '/../Repository/ProductRepository.php';
require_once __DIR__ . '/../DTO/ProductDTO.php';
require_once __DIR__ . '/../Entity/Product.php';

class ProductService {
    private ProductRepository $repository;

    public function __construct() {
        $this->repository = new ProductRepository();
    }

    public function getAllProducts(): array {
        $products = $this->repository->findAll();
        return array_map(fn(Product $p) => $this->toDTO($p), $products);
    }

    public function getProduct(int $id): ?ProductDTO {
        $product = $this->repository->findById($id);
        return $product ? $this->toDTO($product) : null;
    }

    public function addProduct(ProductDTO $dto): void {
        $product = new Product(null, $dto->nom, $dto->prix, $dto->stock);
        $this->repository->save($product);
    }

    public function updateProduct(int $id, ProductDTO $dto): void {
        $product = $this->repository->findById($id);
        if ($product === null) {
            throw new RuntimeException("Produit introuvable (id=$id)");
        }

        $product->setNom($dto->nom);
        $product->setPrix($dto->prix);
        $product->setStock($dto->stock);

        $this->repository->update($product);
    }

    public function deleteProduct(int $id): void {
        if ($this->repository->findById($id) === null) {
            throw new RuntimeException("Produit introuvable (id=$id)");
        }
        $this->repository->delete($id);
    }

    private function toDTO(Product $product): ProductDTO {
        return new ProductDTO(
            $product->getId(),
            $product->getNom(),
            $product->getPrix(),
            $product->getStock()
        );
    }
}
