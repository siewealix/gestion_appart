<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des appartements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style> body{ font-family: cursive;} </style>
</head>
<body>
<?php
    // Inclusion des classes et de la connexion à la base de données
    require_once('../donnees/Appartement.php');
    require_once('../donnees/Manager.php');
    require_once('../donnees/Connexion.php');
    
    global $bdd;

    // Création d'une instance de Manager
    $manager = new Manager($bdd);
    
    // Si le formulaire a été soumis pour ajouter ou modifier une news
    if (isset($_POST['submit'])) {
        
        $categorie = $_POST['categorie'];
        $type = $_POST['type'];
        $nbpersonnes = $_POST['nbpersonnes'];
        $adresselocation = $_POST['adresselocation'];
        $photo = file_get_contents($_FILES['photo']['tmp_name']);
        $equipements = $_POST['equipements'];
        $codetarif = $_POST['codetarif'];
        $nomproprio = $_POST['nomproprio'];
        $prenomproprio=$_POST['prenomproprio'];

    
        // Si l'identifiant de la news est renseigné, on modifie la news
        if (isset($_POST['numLocation'])) {
            $numLocation = $_POST['numLocation'];
            $appartement = new Appartement($categorie, $type, $nbpersonnes, $adresselocation, $photo, $equipements,$codetarif,$nomproprio,$prenomproprio); // création d'une instance de News avec les nouvelles données
            $appartement->setNumLocation($numLocation); // set l'id de la news
            $manager->updateAppartement($appartement,$numLocation); // mise à jour de la news dans la base de données
            // Message de succès après la modification
            echo '<div class="alert alert-success" role="alert">L\'appartemnt a été modifié avec succès !</div>';

            //reinitialiser les champs du formulaire
            $categorie = '';
            $type = '';
            $nbpersonnes = '';
            $adresselocation = '';
            $photo = '';
            $equipements = '';
            $codetarif = '';
            $nomproprio = '';
            $prenomproprio='';
        }
        // Sinon, on ajoute une nouvelle news
        else {
            $appartement = new Appartement($categorie, $type, $nbpersonnes, $adresselocation, $photo, $equipements,$codetarif,$nomproprio,$prenomproprio); // création d'une instance de News avec les données du formulaire
            $manager->addAppartment($appartement); // ajout de la news dans la base de données
            // Message de succès après l'ajout
            echo '<div class="alert alert-success" role="alert">L\'appartement a été ajoutée avec succès !</div>';

            //reinitialiser les champs du formulaire
            $categorie = '';
            $type = '';
            $nbpersonnes = '';
            $adresselocation = '';
            $photo = '';
            $equipements = '';
            $codetarif = '';
            $nomproprio = '';
            $prenomproprio='';
        }
    }
    
    // Si l'identifiant d'une news est renseigné pour la modifier ou la supprimer
    if (isset($_GET['action']) && isset($_GET['numLocation'])) {
        $action = $_GET['action'];
        $numLocation = $_GET['numLocation'];
    
        // Si on souhaite modifier une news, on pré-remplit le formulaire avec ses informations
        if ($action == 'edit') {
            $appartement = $manager->getAppartementByNumLocation($numLocation);
            $categorie =$appartement->getCategorie();
            $type = $appartement->getType();
            $nbpersonnes = $appartement->getNbPersonnes();
            $adresselocation = $appartement->getAdresseLocation();
            $photo = $appartement->getPhoto();
            $equipements = $appartement->getEquipements();
            $codetarif = $appartement->getCodeTarif();

            global $bdd;
            $sql = "SELECT Nom,Prenom FROM PROPRIETAIRE WHERE Num = ?";
            $st = $bdd->prepare($sql);
            $st->bindValue(1, $appartement->getNumProprietaire());
            $st->execute();
            $row = $st->fetch(PDO::FETCH_ASSOC);
            $nomproprio=$row['Nom'];
            $prenomproprio=$row['Prenom'];

        }
        // Sinon, on supprime la news correspondante
        else if ($action == 'delete') {
            $manager->deleteAppartement($numLocation);
            // Message de succès après la suppression
        echo '<div class="alert alert-success" role="alert">L\'appartement a été supprimée avec succès !</div>';

        
        }
    }
    
    
    
    

// Récupération de toutes les news
$allAppartements = $manager->getAllAppartements();
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
<h1>Gestion des appartements</h1>
<!-- Formulaire pour ajouter ou modifier une news -->
<form method="POST" action="liste_appartements.php" enctype="multipart/form-data">
    <?php
    // Si on modifie une news, on ajoute un champ caché pour stocker son identifiant
    if (isset($numLocation)) {
        echo '<input type="hidden" name="numLocation" value="'.$numLocation.'">';
    }
    ?>
    <div class="form-group">
        <label for="categorie"></label>
        <input type="text" class="form-control" id="categorie" name="categorie" placeholder="Categorie" value="<?php echo isset($categorie) ? $categorie : ''; ?>" required>
    </div>

    <div class="form-group">
        <label for="type"></label>
        <input type="text" class="form-control" id="type" name="type" placeholder="Type" value="<?php echo isset($type) ? $type : ''; ?>" required>
    </div>

    <div class="form-group">
        <label for="nbpersonnes"></label>
        <input type="text" class="form-control" id="nbpersonnes" name="nbpersonnes" placeholder="Nombre de personnes" value="<?php echo isset($nbpersonnes) ? $nbpersonnes : ''; ?>" required>
    </div>

    <div class="form-group">
        <label for="adresselocation"></label>
        <input type="text" class="form-control" id="adresselocation" name="adresselocation" placeholder="Adresse de location" value="<?php echo isset($adresselocation) ? $adresselocation : ''; ?>" required>
    </div>

    <div class="form-group">
        <label for="photo"></label>
        <input type="file" class="form-control" id="photo" name="photo" accept="image/*" placeholder="Photo" value="<?php if(isset($photo)){ $photo=base64_encode($photo); echo $photo;
    }else {  echo '';}; ?>" required>
    </div>

    <div class="form-group">
        <label for="equipements"></label>
        <input type="text" class="form-control" id="equipements" name="equipements" placeholder="Equipements" value="<?php echo isset($equipements) ? $equipements : ''; ?>" required>
    </div>

    <div class="form-group">
        <label for="codetarif"></label>
        <input type="text" class="form-control" id="codetarif" name="codetarif" placeholder="Code du tarif" value="<?php echo isset($codetarif) ? $codetarif : ''; ?>" required>
    </div>

    <div class="form-group">
        <label for="nomproprio"></label>
        <input type="text" class="form-control" id="nomproprio" name="nomproprio" placeholder="Nom du propriétaire" value="<?php echo isset($nomproprio) ? $nomproprio : ''; ?>" required>
    </div>

    <div class="form-group">
        <label for="prenomproprio"></label>
        <input type="text" class="form-control" id="prenomproprio" name="prenomproprio" placeholder="Prenom du propriétaire" value="<?php echo isset($prenomproprio) ? $prenomproprio : ''; ?>" required>
    </div>
    <br>
    <button type="submit" name="submit" class="btn btn-primary"><?php if (isset($numLocation)) echo 'Modifier'; else echo 'Ajouter'; ?> l'appartement</button>
</form>
<br>
<br>
<h2>Liste des appartements</h2>
<table class="table table-striped">
 <thead>
    <tr>
        <th>Numero de Location</th>
        <th>Categorie</th>
        <th>Type</th>
        <th>Nombre de personnes</th>
        <th>Adresse de location</th>
        <th>Photo</th>
        <th>Equipements</th>
        <th>Code du tarif</th>
        <th>Numero du proprietaire</th>
    </tr>
  </thead>
  <tbody>
<?php
// Récupération de toutes les news
$allAppartements = $manager->getAllAppartements();

// Affichage de chaque news dans le tableau
foreach ($allAppartements as $appartement) {
    echo '<tr>';
    echo '<td>'.$appartement->getNumLocation().'</td>';
    echo '<td>'.$appartement->getCategorie().'</td>';
    echo '<td>'.$appartement->getType().'</td>';
    echo '<td>'.$appartement->getNbPersonnes().'</td>';
    echo '<td>'.$appartement->getAdresseLocation().'</td>';
    $photo=base64_encode($appartement->getPhoto());
    echo '<td style="width: 400px;"><img style="width: 100%;" src="data:image/jpeg;base64,'.$photo.'"/></td>';
    echo '<td>'.$appartement->getEquipements().'</td>';
    echo '<td>'.$appartement->getCodeTarif().'</td>';
    echo '<td>'.$appartement->getNumProprietaire().'</td>';
    echo '<td>';
    echo '<a class="btn btn-primary" href="?action=edit&numLocation='.$appartement->getNumLocation().'">&nbsp;&nbsp;&nbsp;Modifier</a>';
    echo '<a class="btn btn-danger" href="?action=delete&numLocation='.$appartement->getNumLocation().'">Supprimer</a>';
    echo '</td>';
    echo '</tr>';
}
?>
</tbody>
</table>
</div>
</div>
</div>
<!-- Ajout du CDN de Bootstrap 5 pour les scripts Javascript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>>
    
</body>
</html>