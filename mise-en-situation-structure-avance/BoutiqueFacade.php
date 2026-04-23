<?php
require_once 'ProduitManagerProxy.php';

class BoutiqueFacade {
    private $produitManager;

    public function __construct() {
       
        $this->produitManager = new ProduitManagerProxy();
    }

    public function ajouterProduit($id, $libelle, $prix) {
        $produit = new Produit($id, $libelle, $prix);
        $this->produitManager->ajouterProduit($produit);
    }

    public function afficherProduit($id) {
        $produit = $this->produitManager->getProduit($id);
        if ($produit === null) {
            echo " Produit avec id {$id} introuvable.<br>";
            return;
        }
        echo " Produit : {$produit->getLibelle()} - {$produit->getPrix()} €<br>";
    }
}
?>