<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<?php
require_once 'Connexion.php'; // inclure le fichier de connexion à la base de données

class Appartement {
    private $numLocation;
    private $categorie;
    private $type;
    private $nbPersonnes;
    private $adresseLocation;
    private $photo;
    private $equipements;
    private $codeTarif;
    private $numProprietaire;

    public function __construct($categorie, $type, $nbPersonnes, $adresseLocation, $photo, $equipements, $codeTarif, $nomProprio, $prenomProprio) {
        global $bdd; // récupérer la connexion PDO à la base de données

        // préparer la requête SQL pour récupérer le Num à partir du nom et prénom du propriétaire
        $sql = "SELECT Num FROM PROPRIETAIRE WHERE Nom = ? AND Prenom = ?";
        $stmt = $bdd->prepare($sql);
    
        // lier les paramètres de la requête aux valeurs passées en paramètres
        $stmt->bindValue(1, $nomProprio, PDO::PARAM_STR);
        $stmt->bindValue(2, $prenomProprio, PDO::PARAM_STR);
    
        // exécuter la requête SQL
        $stmt->execute();
    
        // récupérer le résultat de la requête et retourner le Num
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->numProprietaire = $resultat['Num'];
        $this->categorie = $categorie;
        $this->type = $type;
        $this->nbPersonnes = $nbPersonnes;
        $this->adresseLocation = $adresseLocation;
        $this->photo = $photo;
        $this->equipements = $equipements;
        $this->codeTarif = $codeTarif;
    }


    public function getNumLocation() {
        global $bdd;
        $query = $bdd->query("SELECT NumLocation FROM APPARTEMENT WHERE Categorie='$this->categorie' AND Type='$this->type' AND NbPersonnes=$this->nbPersonnes AND AdresseLocation='$this->adresseLocation' AND Equipements='$this->equipements' AND CodeTarif=$this->codeTarif AND Num=$this->numProprietaire");

        // récupérer le résultat de la requête et retourner le Num
        $resultat = $query->fetch(PDO::FETCH_ASSOC);
        $this->numLocation = $resultat['NumLocation'];
        return $this->numLocation;
    }

    public function getCategorie() {
        return $this->categorie;
    }

    public function getType() {
        return $this->type;
    }

    public function getNbPersonnes() {
        return $this->nbPersonnes;
    }

    public function getAdresseLocation() {
        return $this->adresseLocation;
    }

    public function getPhoto() {
        return $this->photo;
    }

    public function getEquipements() {
        return $this->equipements;
    }

    public function getCodeTarif() {
        return $this->codeTarif;
    }

    public function getNumProprietaire() {
        return $this->numProprietaire;
    }

    public function setNumLocation($numLocation) {
        $this->numLocation=$numLocation;
    }

    public function setCategorie($categorie) {
        $this->categorie = $categorie;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function setNbPersonnes($nbPersonnes) {
        $this->nbPersonnes = $nbPersonnes;
    }

    public function setAdresseLocation($adresseLocation) {
        $this->adresseLocation = $adresseLocation;
    }

    public function setPhoto($photo) {
        $this->photo = $photo;
    }

    public function setEquipements($equipements) {
        $this->equipements = $equipements;
    }

    public function setCodeTarif($codeTarif) {
        $this->codeTarif = $codeTarif;
    }

    public function setNumProprietaire($numProprietaire) {
        $this->numProprietaire = $numProprietaire;
    }

    public function ajouterAppartement() {
        global $bdd; // récupérer la connexion PDO à la base de données

        // préparer la requête SQL pour insérer l'appartement dans la table APPARTEMENT
        $sql = "INSERT INTO APPARTEMENT (Categorie, Type, NbPersonnes, AdresseLocation, Photo, Equipements, CodeTarif, Num) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $bdd->prepare($sql);
    // lier les valeurs des paramètres de la requête SQL
    $stmt->bindParam(1, $this->categorie);
    $stmt->bindParam(2, $this->type);
    $stmt->bindParam(3, $this->nbPersonnes);
    $stmt->bindParam(4, $this->adresseLocation);
    $stmt->bindParam(5, $this->photo);
    $stmt->bindParam(6, $this->equipements);
    $stmt->bindParam(7, $this->codeTarif);
    $stmt->bindParam(8, $this->numProprietaire);

    
    if($stmt->execute()){
    echo '<div class="alert alert-success" role="alert">Appartement crée avec succès.</div>';
    }
    else{
        echo "Erreur: Impossible de créer cet Appartement.";
    }
}


}

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>      
