<?php 

require_once('../donnees/Locataire.php');

  // Récupérer les données du formulaire
  $nomLocataire = $_POST["nomLocataire"];
  $prenomLocataire = $_POST["prenomLocataire"];
  $adresse1Locataire = $_POST["adresse1Locataire"];
  $adresse2Locataire = $_POST["adresse2Locataire"];
  $codePostalLocataire = $_POST["codePostalLocataire"];
  $villeLocataire = $_POST["villeLocataire"];
  $numTel2Locataire = $_POST["numTel2Locataire"];
  $numTel1Locataire = $_POST["numTel1Locataire"];
  $emailLocataire = $_POST["emailLocataire"];

  $locataire= New Locataire($nomLocataire,$prenomLocataire,$adresse1Locataire,$adresse2Locataire,$codePostalLocataire,$villeLocataire,$numTel1Locataire,$numTel2Locataire,$emailLocataire);
  $locataire->ajouterLocataire();

?>