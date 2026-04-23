<?php
require_once 'ProduitManager.php';

class ProduitManagerProxy {
    private $manager;

    public function __construct() {
        $this->manager = new ProduitManager();
    }

    public function ajouterProduit(Produit $produit) {
        
        if ($produit->getPrix() < 0) {
            echo " Erreur : le prix du produit '{$produit->getLibelle()}' est négatif. Ajout refusé.<br>";
            return;
        }
        $this->manager->ajouterProduit($produit);
        echo " Produit '{$produit->getLibelle()}' ajouté avec succès.<br>";
    }

    public function getProduit($id) {
        return $this->manager->getProduit($id);
    }
}
?>