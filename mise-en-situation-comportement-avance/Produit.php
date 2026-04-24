<?php
class Produit {
    private $id;
    private $nom;
    private $prix;
    private $stock;

    public function __construct($nom, $prix, $stock, $id = null) {
        $this->nom = $nom;
        $this->prix = $prix;
        $this->stock = $stock;
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function getStock() {
        return $this->stock;
    }
    public function setStock($stock) {
        $this->stock = $stock;
    }
    public function setPrix($prix) {
        $this->prix = $prix;
    }
    public function setNom($nom) {
        $this->nom = $nom;
    }
}