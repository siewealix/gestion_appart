<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un tarif</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

<form method="post" action="../traitement/ajout_tarif.php">
  <br><br><br><br>
  <label for="codeTarif">Code tarif :</label>
  <input type="number" class="form-control" id="codeTarif" name="codeTarif" required>

  <label for="prixsemHS">Prix semaine haute saison :</label>
  <input type="number" class="form-control" id="prixsemHS" name="prixsemHS" step="0.01" required>

  <label for="prixSemBS">Prix semaine basse saison :</label>
  <input type="number" class="form-control" id="prixsemBS" name="prixsemBS" step="0.01" required>
<br>
  <input type="submit" class="btn btn-success form-control" value="Créer">
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>      
</body>
</html>