<?php 

require_once('../donnees/Appartement.php');

$categorie = $_POST['categorie'];
$type = $_POST['type'];
$nbPersonnes = $_POST['nbPersonnes'];
$adresseLocation = $_POST['adresseLocation'];
$photo = file_get_contents($_FILES['photo']['tmp_name']);
$equipements = $_POST['equipements'];
$codeTarif = $_POST['codeTarif'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];

$appartement=New Appartement($categorie,$type,$nbPersonnes,$adresseLocation,$photo,$equipements,$codeTarif,$nom,$prenom);

$appartement->ajouterAppartement();



?>