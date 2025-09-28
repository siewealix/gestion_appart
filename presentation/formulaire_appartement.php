<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un appartement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<form method="post" action="../traitement/ajout_appartement.php" enctype="multipart/form-data">
  <label for="categorie">Catégorie :</label>
  <input type="text" class="form-control" id="categorie" name="categorie" required>

  <label for="type">Type :</label>
  <input type="text" class="form-control" id="type" name="type" required>

  <label for="nbPersonnes">Nombre de personnes :</label>
  <input type="number" class="form-control" id="nbPersonnes" name="nbPersonnes" required>

  <label for="adresseLocation">Adresse de la location :</label>
  <input type="text" class="form-control" id="adresseLocation" name="adresseLocation" required>

  <label for="photo">Photo :</label>
  <input type="file" class="form-control" id="photo" name="photo" accept="image/*" required>

  <label for="equipements">Équipements :</label>
  <input type="text" class="form-control" id="equipements" name="equipements" required>

  <label for="codeTarif">Code tarif :</label>
  <!--input type="number" class="form-control" id="codeTarif" name="codeTarif" required-->
  <select name="codeTarif" id="codeTarif" required class="form-control">
                    <option value=""></option>
                                <?php
                                    include('../donnees/Connexion.php');
                                    global $bdd;
                                    $requete="SELECT CodeTarif FROM tarif";
                                    $stmt=$bdd->prepare($requete);
                                    $stmt->execute();
                                    if($results=$stmt->fetchAll(PDO::FETCH_ASSOC)){
                                          foreach($results as $result){
                                                echo '<option value='.$result['CodeTarif'].'>'.$result['CodeTarif'].'</option>';
                                          }
                                    }

                                    else{
                                          echo "Une erreur est survenue";
                                    }

                                ?></select>

  <label for="nom">Nom du propriétaire :</label>
  <!--input type="text" class="form-control" id="nom" name="nom" required-->
  <select name="nom" id="nom" required class="form-control">
                    <option value=""></option>
                                <?php
                                    include('../donnees/Connexion.php');
                                    global $bdd;
                                    $requete="SELECT Nom FROM proprietaire";
                                    $stmt=$bdd->prepare($requete);
                                    $stmt->execute();
                                    if($results=$stmt->fetchAll(PDO::FETCH_ASSOC)){
                                          foreach($results as $result){
                                                echo '<option value='.$result['Nom'].'>'.$result['Nom'].'</option>';
                                          }
                                    }

                                    else{
                                          echo "Une erreur est survenue";
                                    }

                                ?></select>

  <label for="prenom">Prénom du propriétaire :</label>
  <!--input type="text" class="form-control" id="prenom" name="prenom" required-->
  <select name="prenom" id="prenom" required class="form-control">
                    <option value=""></option>
                                <?php
                                    include('../donnees/Connexion.php');
                                    global $bdd;
                                    $requete="SELECT Prenom FROM proprietaire";
                                    $stmt=$bdd->prepare($requete);
                                    $stmt->execute();
                                    if($results=$stmt->fetchAll(PDO::FETCH_ASSOC)){
                                          foreach($results as $result){
                                                echo '<option value='.$result['Prenom'].'>'.$result['Prenom'].'</option>';
                                          }
                                    }

                                    else{
                                          echo "Une erreur est survenue";
                                    }

                                ?></select>
  <br>

  <input type="submit" class="btn btn-success form-control" value="Créer">
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>