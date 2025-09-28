<?php 

require_once('../donnees/Contrat.php');

  // Récupération des données du formulaire
  $numContrat = $_POST['numContrat'];
  $etat = $_POST['etat'];
  $dateCreation = $_POST['dateCreation'];
  $dateDebut = $_POST['dateDebut'];
  $dateFin = $_POST['dateFin'];
  $numLocation = $_POST['numLocation'];
  $nomLocataire = $_POST['nomLocataire'];
  $prenomLocataire = $_POST['prenomLocataire'];

  $contrat=New Contrat($numContrat,$etat,$dateCreation,$dateDebut,$dateFin,$numLocation,$nomLocataire,$prenomLocataire);
  $contrat->modifierContrat();

?>