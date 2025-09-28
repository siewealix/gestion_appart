<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<?php
require_once 'Connexion.php'; // inclure le fichier de connexion à la base de données
//require_once 'dompdf/autoload.php';

class Proprietaire {

    private $num;
    private $nom;
    private $prenom;
    private $adresse1;
    private $adresse2;
    private $codePostal;
    private $ville;
    private $numTel1;
    private $numTel2;
    private $caAcumule;
    private $email;

    public function __construct($nom, $prenom, $adresse1, $adresse2, $codePostal, $ville, $numTel1, $numTel2, $caAcumule, $email) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->adresse1 = $adresse1;
        $this->adresse2 = $adresse2;
        $this->codePostal = $codePostal;
        $this->ville = $ville;
        $this->numTel1 = $numTel1;
        $this->numTel2 = $numTel2;
        $this->caAcumule = $caAcumule;
        $this->email = $email;
    }

    public function getNum() {
        return $this->num;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function getAdresse1() {
        return $this->adresse1;
    }

    public function setAdresse1($adresse1) {
        $this->adresse1 = $adresse1;
    }

    public function getAdresse2() {
        return $this->adresse2;
    }

    public function setAdresse2($adresse2) {
        $this->adresse2 = $adresse2;
    }

    public function getCodePostal() {
        return $this->codePostal;
    }

    public function setCodePostal($codePostal) {
        $this->codePostal = $codePostal;
    }

    public function getVille() {
        return $this->ville;
    }

    public function setVille($ville) {
        $this->ville = $ville;
    }

    public function getNumTel1() {
        return $this->numTel1;
    }

    public function setNumTel1($numTel1) {
        $this->numTel1 = $numTel1;
    }

    public function getNumTel2() {
        return $this->numTel2;
    }

    public function setNumTel2($numTel2) {
        $this->numTel2 = $numTel2;
    }

    public function getCaAcumule() {
        return $this->caAcumule;
    }

    public function setCaAcumule($caAcumule) {
        $this->caAcumule = $caAcumule;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function ajouterProprietaire() {
        global $bdd; // récupérer la connexion PDO à la base de données

        // préparer la requête SQL pour insérer le propriétaire dans la table PROPRIETAIRE
        $sql = "INSERT INTO PROPRIETAIRE (Nom, Prenom, Adresse1, Adresse2, CodePostal, Ville, NumTel2, NumTel1, CAcumule, Email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $bdd->prepare($sql);

         // lier les paramètres de la requête avec les valeurs des attributs de l'objet propriétaire courant
    $stmt->bindParam(1, $this->nom);
    $stmt->bindParam(2, $this->prenom);
    $stmt->bindParam(3, $this->adresse1);
    $stmt->bindParam(4, $this->adresse2);
    $stmt->bindParam(5, $this->codePostal);
    $stmt->bindParam(6, $this->ville);
    $stmt->bindParam(7, $this->numTel2);
    $stmt->bindParam(8, $this->numTel1);
    $stmt->bindParam(9, $this->caAcumule);
    $stmt->bindParam(10, $this->email);

    // exécuter la requête
    if ($stmt->execute()) {
        echo '<div class="alert alert-success" role="alert">Propriétaire crée avec succès.</div>';
    } else {
        echo "Erreur: Impossible de créer ce Propriétaire.";
    }
}

}

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>      


