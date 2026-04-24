<?php

require_once 'Produit.php';
require_once 'ProduitRepository.php';
require_once 'PrixHandler.php';
require_once 'StockHandler.php';
require_once 'NomHandler.php';
require_once 'AjouterProduitCommand.php';
require_once 'ModifierProduitCommand.php';
require_once 'SupprimerProduitCommand.php';
require_once 'CommandInvoker.php';
require_once 'HandlerInterface.php';
require_once 'AbstractHandler.php';


function buildChain(): HandlerInterface
{
    $prix  = new PrixHandler();
    $stock = new StockHandler();
    $nom   = new NomHandler();

    $prix->setNext($stock)->setNext($nom);

    return $prix;
}

$repo    = new ProduitRepository();
$invoker = new CommandInvoker();

try {
    $p   = new Produit('Laptop Pro', 1299.99, 10);
    $cmd = new AjouterProduitCommand($p, $repo, buildChain());
    $invoker->run($cmd);
} catch (InvalidArgumentException $e) {
    echo nl2br("Erreur : " . $e->getMessage() . "\n");
}


try {
    $p   = new Produit('Souris', -5.00, 50);
    $cmd = new AjouterProduitCommand($p, $repo, buildChain());
    $invoker->run($cmd);
} catch (InvalidArgumentException $e) {
    echo nl2br("Erreur : " . $e->getMessage() . "\n");
}


try {
    $p   = new Produit('PC', 500.00, 5);
    $cmd = new AjouterProduitCommand($p, $repo, buildChain());
    $invoker->run($cmd);
} catch (InvalidArgumentException $e) {
    echo nl2br("Erreur : " . $e->getMessage() . "\n");
}


try {
    $p   = new Produit('Laptop Pro Max', 1499.99, 5, 1);
    $cmd = new ModifierProduitCommand($p, $repo, buildChain());
    $invoker->run($cmd);
} catch (InvalidArgumentException $e) {
    echo nl2br("Erreur : " . $e->getMessage() . "\n");
}


$invoker->run(new SupprimerProduitCommand(1, $repo));

echo nl2br("\n=== " . count($invoker->getHistory()) . " commande(s) exécutée(s) ===\n");