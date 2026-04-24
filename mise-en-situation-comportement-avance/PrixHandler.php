<?php
require_once 'AbstractHandler.php';

class PrixHandler extends AbstractHandler {
    public function handle(Produit $produit): void {
        if ($produit->getPrix() < 0) {
            throw new InvalidArgumentException("Le prix ne peut pas être négatif.");
        }
        $this->passToNext($produit);
    }
}