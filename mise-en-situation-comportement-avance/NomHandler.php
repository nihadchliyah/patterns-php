<?php
require_once 'AbstractHandler.php';

class NomHandler extends AbstractHandler {
    public function handle(Produit $produit): void {
        if (strlen($produit->getNom()) <= 3) {
            throw new InvalidArgumentException("Le nom doit contenir plus de 3 caractères.");
        }
        $this->passToNext($produit);


     
    }
} 