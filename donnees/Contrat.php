<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<?php
require_once ('Connexion.php'); // inclure le fichier de connexion à la base de données
require_once('dompdf/autoload.inc.php');

class Contrat {

    private $numContrat;
    private $etat;
    private $dateCreation;
    private $dateDebut;
    private $dateFin;
    private $numLocation;
    private $numLocataire;

    public function __construct($numContrat, $etat, $dateCreation, $dateDebut, $dateFin, $numLocation,$nomLocataire,$prenomLocataire ) {
                
                global $bdd;
                // préparer la requête SQL pour récupérer le Num à partir du nom et prénom du propriétaire
                $sql = "SELECT NumLocataire FROM LOCATAIRE WHERE NomLocataire = ? AND PrenomLocataire = ?";
                $stmt = $bdd->prepare($sql);
            
                // lier les paramètres de la requête aux valeurs passées en paramètres
                $stmt->bindValue(1, $nomLocataire, PDO::PARAM_STR);
                $stmt->bindValue(2, $prenomLocataire, PDO::PARAM_STR);
            
                // exécuter la requête SQL
                if($stmt->execute()){}else {}
            
                // récupérer le résultat de la requête et retourner le Num
                $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->numLocataire = $resultat['NumLocataire'];
        
        $this->numContrat = $numContrat;
        $this->etat = $etat;
        $this->dateCreation = $dateCreation;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->numLocation = $numLocation;
    }

    public function getNumContrat() {
        return $this->numContrat;
    }

    public function setNumContrat($numContrat) {
        $this->numContrat = $numContrat;
    }

    public function getEtat() {
        return $this->etat;
    }

    public function setEtat($etat) {
        $this->etat = $etat;
    }

    public function getDateCreation() {
        return $this->dateCreation;
    }

    public function setDateCreation($dateCreation) {
        $this->dateCreation = $dateCreation;
    }

    public function getDateDebut() {
        return $this->dateDebut;
    }

    public function setDateDebut($dateDebut) {
        $this->dateDebut = $dateDebut;
    }

    public function getDateFin() {
        return $this->dateFin;
    }

    public function setDateFin($dateFin) {
        $this->dateFin = $dateFin;
    }

    public function getNumLocation() {
        return $this->numLocation;
    }

    public function setNumLocation($numLocation) {
        $this->numLocation = $numLocation;
    }

    public function getNumLocataire() {
        return $this->numLocataire;
    }

    public function setNumLocataire($numLocataire) {
        $this->numLocataire = $numLocataire;
    }

    public function ajouterContrat() {
        global $bdd; // récupérer la connexion PDO à la base de données

        // préparer la requête SQL pour insérer le contrat dans la table CONTRAT
        $sql = "INSERT INTO CONTRAT (NumContrat, Etat, DateCreation, DateDebut, DateFin, NumLocation, NumLocataire) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $bdd->prepare($sql);

        // lier les paramètres de la requête aux valeurs des propriétés de l'objet
        $stmt->bindValue(1, $this->numContrat, PDO::PARAM_STR);
        $stmt->bindValue(2, $this->etat, PDO::PARAM_STR);
        $stmt->bindValue(3, $this->dateCreation, PDO::PARAM_STR);
        $stmt->bindValue(4, $this->dateDebut, PDO::PARAM_STR);
        $stmt->bindValue(5, $this->dateFin, PDO::PARAM_STR);
        $stmt->bindValue(6, $this->numLocation, PDO::PARAM_STR);
        $stmt->bindValue(7, $this->numLocataire, PDO::PARAM_STR);

    // exécuter la requête
    if($stmt->execute()){
        echo '<div class="alert alert-success" role="alert">Contrat passé avec succès.</div>';
    }
    else {
        echo "Impossible de passer ce contrat.";
    }
}

public function imprimerContrat() {
    // créer une nouvelle instance de Dompdf
    $dompdf = new Dompdf\Dompdf();

    // récupérer le contenu HTML du contrat
    $html = "<h1>Contrat de location</h1>";
    $html .= "<p>Numéro de contrat : " . $this->numContrat . "</p>";
    $html .= "<p>État du contrat : " . $this->etat . "</p>";
    $html .= "<p>Date de création : " . $this->dateCreation . "</p>";
    $html .= "<p>Date de début de location : " . $this->dateDebut . "</p>";
    $html .= "<p>Date de fin de location : " . $this->dateFin . "</p>";
    $html .= "<p>Numéro de location : " . $this->numLocation . "</p>";
    $html .= "<p>Numéro de locataire : " . $this->numLocataire . "</p>";

    // générer le PDF à partir du contenu HTML
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // envoyer le PDF au navigateur pour qu'il soit téléchargé ou affiché
    $dompdf->stream('contrat_location.pdf', array('Attachment' => 0));
}

public function modifierContrat() {
    global $bdd; // récupérer la connexion PDO à la base de données

    // préparer la requête SQL pour mettre à jour le contrat dans la table CONTRAT
    $sql = "UPDATE CONTRAT SET Etat=?, DateCreation=?, DateDebut=?, DateFin=?, NumLocation=?, NumLocataire=? WHERE NumContrat=?";
    $stmt = $bdd->prepare($sql);

    // lier les paramètres de la requête aux valeurs des propriétés de l'objet
    $stmt->bindValue(1, $this->etat, PDO::PARAM_STR);
    $stmt->bindValue(2, $this->dateCreation, PDO::PARAM_STR);
    $stmt->bindValue(3, $this->dateDebut, PDO::PARAM_STR);
    $stmt->bindValue(4, $this->dateFin, PDO::PARAM_STR);
    $stmt->bindValue(5, $this->numLocation, PDO::PARAM_STR);
    $stmt->bindValue(6, $this->numLocataire, PDO::PARAM_STR);
    $stmt->bindValue(7, $this->numContrat, PDO::PARAM_STR);

    // exécuter la requête SQL pour mettre à jour le contrat
    if($stmt->execute()){
        echo '<div class="alert alert-success" role="alert">Contrat modifié avec succès.</div>';
    }
    else {
        echo "Une erreur est survenue. ";
    }
}

public function resilierContrat() {
    global $bdd; // récupérer la connexion PDO à la base de données
    
    // préparer la requête SQL pour mettre à jour la date de fin du contrat dans la table CONTRAT
    $sql = "UPDATE CONTRAT SET Etat = 'non valide' WHERE NumContrat = ?";
    $stmt = $bdd->prepare($sql);
    
    // lier les paramètres de la requête aux valeurs des propriétés de l'objet
    $stmt->bindValue(1, $this->numContrat, PDO::PARAM_STR);
    
    // exécuter la requête SQL
    if($stmt->execute()){
        echo '<div class="alert alert-success" role="alert">Contrat résilié avec succès.</div>';
    }
    else {
        echo "Une erreur est survenue. ";
    }
    
 ;
}



}



?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>      