<?php
require_once 'BoutiqueFacade.php';



echo "<h2> Gestion de la boutique</h2>";

$boutique = new BoutiqueFacade();


$boutique->ajouterProduit(1, "Clavier", 49.99);
$boutique->ajouterProduit(2, "Souris", -10); 
$boutique->ajouterProduit(3, "Casque", 0); 

echo "<hr>";
echo "<h3>Affichage :</h3>";

$boutique->afficherProduit(1);
$boutique->afficherProduit(2);
$boutique->afficherProduit(3);
?>