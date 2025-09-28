<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<?php
require_once 'Connexion.php'; // inclure le fichier de connexion à la base de données

class Locataire {
    private $numLocataire;
    private $nomLocataire;
    private $prenomLocataire;
    private $adresse1Locataire;
    private $adresse2Locataire;
    private $codePostalLocataire;
    private $villeLocataire;
    private $numTel2Locataire;
    private $numTel1Locataire;
    private $emailLocataire;

    public function __construct($nomLocataire, $prenomLocataire, $adresse1Locataire, $adresse2Locataire, $codePostalLocataire, $villeLocataire, $numTel2Locataire, $numTel1Locataire, $emailLocataire) {
        $this->nomLocataire = $nomLocataire;
        $this->prenomLocataire = $prenomLocataire;
        $this->adresse1Locataire = $adresse1Locataire;
        $this->adresse2Locataire = $adresse2Locataire;
        $this->codePostalLocataire = $codePostalLocataire;
        $this->villeLocataire = $villeLocataire;
        $this->numTel2Locataire = $numTel2Locataire;
        $this->numTel1Locataire = $numTel1Locataire;
        $this->emailLocataire = $emailLocataire;
    }

    public function getNumLocataire() {
        return $this->numLocataire;
    }


    public function getNomLocataire() {
        return $this->nomLocataire;
    }

    public function setNomLocataire($nomLocataire) {
        $this->nomLocataire = $nomLocataire;
    }

    public function getPrenomLocataire() {
        return $this->prenomLocataire;
    }

    public function setPrenomLocataire($prenomLocataire) {
        $this->prenomLocataire = $prenomLocataire;
    }

    public function getAdresse1Locataire() {
        return $this->adresse1Locataire;
    }

    public function setAdresse1Locataire($adresse1Locataire) {
        $this->adresse1Locataire = $adresse1Locataire;
    }

    public function getAdresse2Locataire() {
        return $this->adresse2Locataire;
    }

    public function setAdresse2Locataire($adresse2Locataire) {
        $this->adresse2Locataire = $adresse2Locataire;
    }

    public function getCodePostalLocataire() {
        return $this->codePostalLocataire;
    }

    public function setCodePostalLocataire($codePostalLocataire) {
        $this->codePostalLocataire = $codePostalLocataire;
    }

    public function getVilleLocataire() {
        return $this->villeLocataire;
    }

    public function setVilleLocataire($villeLocataire) {
        $this->villeLocataire = $villeLocataire;
    }

    public function getNumTel2Locataire() {
        return $this->numTel2Locataire;
    }

    public function setNumTel2Locataire($numTel2Locataire) {
        $this->numTel2Locataire = $numTel2Locataire;
    }

    public function getNumTel1Locataire() {
        return $this->numTel1Locataire;
    }

    
    public function setNumTel1Locataire($numTel1Locataire) {
        $this->numTel1Locataire = $numTel1Locataire;
    }
    
    public function getEmailLocataire() {
        return $this->emailLocataire;
    }
    
    public function setEmailLocataire($emailLocataire) {
        $this->emailLocataire = $emailLocataire;
    }
    
    public function ajouterLocataire() {
        global $bdd; // récupérer la connexion PDO à la base de données
    
        // préparer la requête SQL pour insérer le locataire dans la table LOCATAIRE
        $sql = "INSERT INTO LOCATAIRE (NomLocataire, PrenomLocataire, Adresse1Locataire, Adresse2Locataire, CodePostalLocataire, VilleLocataire, NumTel2Locataire, NumTel1Locataire, EmailLocataire) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $bdd->prepare($sql);
    
        // lier les paramètres de la requête aux valeurs des propriétés de l'objet
        $stmt->bindValue(1, $this->nomLocataire, PDO::PARAM_STR);
        $stmt->bindValue(2, $this->prenomLocataire, PDO::PARAM_STR);
        $stmt->bindValue(3, $this->adresse1Locataire, PDO::PARAM_STR);
        $stmt->bindValue(4, $this->adresse2Locataire, PDO::PARAM_STR);
        $stmt->bindValue(5, $this->codePostalLocataire, PDO::PARAM_STR);
        $stmt->bindValue(6, $this->villeLocataire, PDO::PARAM_STR);
        $stmt->bindValue(7, $this->numTel2Locataire, PDO::PARAM_STR);
        $stmt->bindValue(8, $this->numTel1Locataire, PDO::PARAM_STR);
        $stmt->bindValue(9, $this->emailLocataire, PDO::PARAM_STR);
    
        // exécuter la requête SQL
        if($stmt->execute()){
            echo '<div class="alert alert-success" role="alert">Locataire crée avec succès.</div>';
        } else {
            echo "Erreur: Impossible de créer ce Locataire.";
        }
    }
    
}
?>   
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>       
