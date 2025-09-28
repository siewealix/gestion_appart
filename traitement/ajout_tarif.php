<?php 

require_once('../donnees/Tarif.php');

$codeTarif = $_POST['codeTarif'];
$prixSemHS = $_POST['prixsemHS'];
$prixSemBS = $_POST['prixsemBS'];

$tarif= New Tarif($codeTarif,$prixSemHS,$prixSemBS);
$tarif->ajouterTarif();


?>