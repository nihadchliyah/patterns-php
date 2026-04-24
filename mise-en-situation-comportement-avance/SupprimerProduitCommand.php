<?php
require_once 'CommandInterface.php';
require_once 'ProduitRepository.php';

class SupprimerProduitCommand implements CommandInterface {
    private int $id;
    private ProduitRepository $repo;


    public function __construct(int $id, ProduitRepository $repo)
    {
        $this->id = $id;
        $this->repo = $repo;
    }
    public function execute(): void
    {
        $this->repo->supprimer($this->id);
        echo nl2br("Produit supprimé avec succès : ID " . $this->id . "\n");
    }
}