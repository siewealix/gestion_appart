<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passer contrat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<form method="post" action="../traitement/ajout_contrat.php">
  <label for="numContrat">Numéro de contrat :</label>
  <input type="number" class="form-control" id="numContrat" name="numContrat" required>

  <label for="etat">Etat :</label>
  <input type="text" class="form-control" id="etat" name="etat" required>

  <label for="dateCreation">Date de création :</label>
  <input type="date" class="form-control" id="dateCreation" name="dateCreation" required>

  <label for="dateDebut">Date de début :</label>
  <input type="date" class="form-control" id="dateDebut" name="dateDebut" required>

  <label for="dateFin">Date de fin :</label>
  <input type="date" class="form-control" id="dateFin" name="dateFin" required>

  <label for="numLocation">Numéro de location :</label>
  <!--<input type="number" class="form-control" id="numLocation" name="numLocation" required>-->
 <select name="numLocation" id="numLocation" required class="form-control">
                    <option value=""></option>
                                <?php
                                    include('../donnees/Connexion.php');
                                    global $bdd;
                                    $requete="SELECT NumLocation FROM appartement";
                                    $stmt=$bdd->prepare($requete);
                                    $stmt->execute();
                                    if($results=$stmt->fetchAll(PDO::FETCH_ASSOC)){
                                          foreach($results as $result){
                                                echo '<option value='.$result['NumLocation'].'>'.$result['NumLocation'].'</option>';
                                          }
                                    }

                                    else{
                                          echo "Une erreur est survenue";
                                    }

                                ?></select>

  <label for="nomLocataire">Nom du locataire :</label>
  <input type="text" class="form-control" id="nomLocataire" name="nomLocataire" required>

  <label for="prenomLocataire">Prénom du locataire :</label>
  <input type="text" class="form-control" id="prenomLocataire" name="prenomLocataire" required>
<br>
  <input type="submit" class="btn btn-success form-control" value="Passer le contrat">
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>      
</body>
</html>