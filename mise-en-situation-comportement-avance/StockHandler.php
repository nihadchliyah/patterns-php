<?php

require_once 'HandlerInterface.php';
class StockHandler extends AbstractHandler {

public function handle(Produit $produit): void
    {
       if( $produit->getStock() < 0) {
           throw new InvalidArgumentException("Le stock ne peut pas être négatif.");
       }
       $this->passToNext($produit); 
    }
}