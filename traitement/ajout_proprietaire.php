<?php 

require_once('../donnees/Proprietaire.php');

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$adresse1 = $_POST['adresse1'];
$adresse2 = $_POST['adresse2'];
$codePostal = $_POST['codePostal'];
$ville = $_POST['ville'];
$numTel1 = $_POST['numTel1'];
$numTel2 = $_POST['numTel2'];
$caCumule = $_POST['caCumule'];
$email = $_POST['email'];

$proprietaire= New Proprietaire($nom,$prenom,$adresse1,$adresse2,$codePostal,$ville,$numTel1,$numTel2,$caCumule,$email);

$proprietaire->ajouterProprietaire();

?>