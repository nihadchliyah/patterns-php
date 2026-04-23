<?php

class Produit {
    private $id;
    private $libelle;
    private $prix;

    public function __construct($id, $libelle, $prix) {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->prix = $prix;
    }

    public function getId() {
        return $this->id;
    }

    public function getLibelle() {
        return $this->libelle;
    }

    public function getPrix() {
        return $this->prix;
    }
}
?>