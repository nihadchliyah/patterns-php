<?php
require_once 'Produit.php';


class ProduitManager {
    private $produits = [];

    public function ajouterProduit(Produit $produit) {
        $this->produits[$produit->getId()] = $produit;
    }

    public function getProduit($id) {
        if (isset($this->produits[$id])) {
            return $this->produits[$id];
        }
        return null;
    }
}
?>