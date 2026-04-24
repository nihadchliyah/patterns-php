<?php
require_once 'CommandInterface.php';
require_once 'ProduitRepository.php';
require_once 'PrixHandler.php';
require_once 'StockHandler.php';
require_once 'NomHandler.php';


class AjouterProduitCommand implements CommandInterface {

private Produit $produit;
private ProduitRepository $repo;
private HandlerInterface $validationChain;
public function __construct(Produit $produit, ProduitRepository $repo, HandlerInterface $validationChain)
    {
        $this->produit = $produit;
        $this->repo = $repo;
        $this->validationChain = $validationChain;
    }
    public function execute(): void
    {
        $this->validationChain->handle($this->produit);
        $this->repo->ajouter($this->produit);
        echo nl2br("Produit ajouté avec succès : " . $this->produit->getNom() . " - Prix: " . $this->produit->getPrix() . " - Stock: " . $this->produit->getStock() . "\n");
    }
}

