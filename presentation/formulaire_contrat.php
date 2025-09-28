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

<form method="post" action="../traitement/imprimer_contrat.php">
  <br><br><br><br><br><br>
  <label for="numContrat" style="color: white;">Numéro de contrat à imprimer :</label>
  <!--input type="number" id="numContrat" name="numContrat" required class="form-control"-->
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
                                <br>
  <input type="submit" value="Imprimer le contrat" class="btn btn-success form-control">
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>      
</body>
</html>