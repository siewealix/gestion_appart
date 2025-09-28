<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<?php 

require_once('../donnees/Connexion.php');

  // Récupération des données du formulaire
  $numContrat = $_POST['numContrat'];

  global $bdd; // récupérer la connexion PDO à la base de données
    
  // préparer la requête SQL pour mettre à jour la date de fin du contrat dans la table CONTRAT
  $sql = "UPDATE CONTRAT SET Etat = 'non valide' WHERE NumContrat = ?";
  $stmt = $bdd->prepare($sql);
  
  // lier les paramètres de la requête aux valeurs des propriétés de l'objet
  $stmt->bindValue(1, $numContrat);
  
  // exécuter la requête SQL
  if($stmt->execute()){
    echo '<div class="alert alert-success" role="alert">Contrat résilié avec succès.</div>';
  }
  else {
      echo "Une erreur est survenue. ";
  }

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>      