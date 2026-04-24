<?php

class Product {
    private ?int $id;
    private string $nom;
    private float $prix;
    private int $stock;

    public function __construct(?int $id, string $nom, float $prix, int $stock) {
        $this->id    = $id;
        $this->nom   = $nom;
        $this->prix  = $prix;
        $this->stock = $stock;
    }

    public function getId(): ?int   { return $this->id; }
    public function getNom(): string { return $this->nom; }
    public function getPrix(): float { return $this->prix; }
    public function getStock(): int  { return $this->stock; }

    public function setNom(string $nom): void   { $this->nom   = $nom; }
    public function setPrix(float $prix): void  { $this->prix  = $prix; }
    public function setStock(int $stock): void  { $this->stock = $stock; }
}
