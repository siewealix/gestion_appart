<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier contrat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<form method="post" action="../traitement/modification_contrat.php">
  <label for="numContrat">Entrer le Numéro de contrat à modifier :</label>
  <!--input type="number" class="form-control" id="numContrat" name="numContrat" required>-->
  <select name="numContrat" id="numContrat" required class="form-control">
                    <option value=""></option>
                                <?php
                                    include('../donnees/Connexion.php');
                                    global $bdd;
                                    $requete="SELECT NumContrat FROM contrat";
                                    $stmt=$bdd->prepare($requete);
                                    $stmt->execute();
                                    if($results=$stmt->fetchAll(PDO::FETCH_ASSOC)){
                                          foreach($results as $result){
                                                echo '<option value='.$result['NumContrat'].'>'.$result['NumContrat'].'</option>';
                                          }
                                    }

                                    else{
                                          echo "Une erreur est survenue";
                                    }

                                ?></select>

  <label for="etat">Nouvel Etat :</label>
  <input type="text" class="form-control" id="etat" name="etat" required>

  <label for="dateCreation">Nouvelle Date de création :</label>
  <input type="date" class="form-control" id="dateCreation" name="dateCreation" required>

  <label for="dateDebut">Nouvelle Date de début :</label>
  <input type="date" class="form-control" id="dateDebut" name="dateDebut" required>

  <label for="dateFin">Nouvelle Date de fin :</label>
  <input type="date" class="form-control" id="dateFin" name="dateFin" required>

  <label for="numLocation">Nouveau Numéro de location :</label>
  <input type="number" class="form-control" id="numLocation" name="numLocation" required>

  <label for="nomLocataire">Nouveau Nom du locataire :</label>
  <input type="text" class="form-control" id="nomLocataire" name="nomLocataire" required>

  <label for="prenomLocataire">Nouveau Prénom du locataire :</label>
  <input type="text" class="form-control" id="prenomLocataire" name="prenomLocataire" required>
<br>
  <input type="submit" class="btn btn-success form-control" value="Modifier le contrat">
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>      
</body>
</html>