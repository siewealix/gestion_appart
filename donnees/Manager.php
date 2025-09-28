<?php

require_once('Connexion.php');
require_once('Locataire.php');
//require_once('Appartement.php');

class Manager {
    private $db;

    // Constructeur
    public function __construct(PDO $db) {
        $this->db = $db;
    }


    public function addLocataire(Locataire $locataire) {
        // préparer la requête SQL pour insérer l'appartement dans la table APPARTEMENT
        $sql = "INSERT INTO LOCATAIRE (NomLocataire, PrenomLocataire, Adresse1Locataire, Adresse2Locataire, CodePostalLocataire, VilleLocataire, NumTel2Locataire, NumTel1Locataire, EmailLocataire) VALUES (?,?,?,?,?,?,?,?,?)";
        $stmt = $this->db->prepare($sql);
    // lier les valeurs des paramètres de la requête SQL
    $stmt->bindValue(1, $locataire->getNomLocataire());
    $stmt->bindValue(2, $locataire->getPrenomLocataire());
    $stmt->bindValue(3, $locataire->getAdresse1Locataire());
    $stmt->bindValue(4, $locataire->getAdresse2Locataire());
    $stmt->bindValue(5, $locataire->getCodePostalLocataire());
    $stmt->bindValue(6, $locataire->getVilleLocataire());
    $stmt->bindValue(7, $locataire->getNumTel2Locataire());
    $stmt->bindValue(8, $locataire->getNumTel2Locataire());
    $stmt->bindValue(9, $locataire->getEmailLocataire());

        $stmt->execute();
    }

    public function LocataireToProprietaire(Locataire $locataire) {
        // préparer la requête SQL pour insérer l'appartement dans la table APPARTEMENT
        $sql = "INSERT INTO PROPRIETAIRE (Nom, Prenom, Adresse1, Adresse2, CodePostal, Ville, NumTel2, NumTel1,CAcumule,Email) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->db->prepare($sql);
    // lier les valeurs des paramètres de la requête SQL
    $stmt->bindValue(1, $locataire->getNomLocataire());
    $stmt->bindValue(2, $locataire->getPrenomLocataire());
    $stmt->bindValue(3, $locataire->getAdresse1Locataire());
    $stmt->bindValue(4, $locataire->getAdresse2Locataire());
    $stmt->bindValue(5, $locataire->getCodePostalLocataire());
    $stmt->bindValue(6, $locataire->getVilleLocataire());
    $stmt->bindValue(7, $locataire->getNumTel2Locataire());
    $stmt->bindValue(8, $locataire->getNumTel2Locataire());
    $stmt->bindValue(9, 0);
    $stmt->bindValue(10, $locataire->getEmailLocataire());

        $stmt->execute();
    }

    public function updateLocataire(Locataire $locataire,$numLocataire) {

                // préparer la requête SQL pour insérer l'appartement dans la table APPARTEMENT
                $sql = "UPDATE LOCATAIRE SET NomLocataire=?, PrenomLocataire=?, Adresse1Locataire=?, Adresse2Locataire=?, CodePostalLocataire=?, VilleLocataire=?, NumTel2Locataire=?, NumTel1Locataire=?, EmailLocataire=? WHERE NumLocataire=?";
                $stmt = $this->db->prepare($sql);
            // lier les valeurs des paramètres de la requête SQL
            $stmt->bindValue(1, $locataire->getNomLocataire());
            $stmt->bindValue(2, $locataire->getPrenomLocataire());
            $stmt->bindValue(3, $locataire->getAdresse1Locataire());
            $stmt->bindValue(4, $locataire->getAdresse2Locataire());
            $stmt->bindValue(5, $locataire->getCodePostalLocataire());
            $stmt->bindValue(6, $locataire->getVilleLocataire());
            $stmt->bindValue(7, $locataire->getNumTel2Locataire());
            $stmt->bindValue(8, $locataire->getNumTel2Locataire());
            $stmt->bindValue(9, $locataire->getEmailLocataire());
            $stmt->bindValue(10, $numLocataire);
            //$stmt->bindValue(10, $locataire->getNumLocataire());
        
                $stmt->execute();
            }

                // Méthode pour supprimer un appartement de la base de données
    public function deleteLocataire($numLocataire) {
        $stmt = $this->db->prepare('DELETE FROM LOCATAIRE WHERE NumLocataire = ?');

        $stmt->bindValue(1, $numLocataire);

        $stmt->execute();
    }

    public function getLocataireByNumLocataire($numLocataire)
    {
        // On prépare la requête SQL
        $stmt = $this->db->prepare('SELECT * FROM LOCATAIRE WHERE NumLocataire = ?');
        $stmt->bindValue(1, $numLocataire);

        // On exécute la requête
        $stmt->execute();

        // On récupère le résultat de la requête
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si la requête a renvoyé un résultat, on crée une instance de Appartement avec les données de la base de données
        if ($result !== false) {

            return new Locataire($result['NomLocataire'], $result['PrenomLocataire'], $result['Adresse1Locataire'], $result['Adresse2Locataire'], $result['CodePostalLocataire'], $result['VilleLocataire'], $result['NumTel2Locataire'], $result['NumTel1Locataire'], $result['EmailLocataire']);
        
    
        } else {
            return false;
        }
    }

    public function getAllLocataires()
    {
         // On prépare la requête SQL
         $query = $this->db->query('SELECT * FROM LOCATAIRE');
         
         // On récupère le résultat de la requête
         $results = $query->fetchAll(PDO::FETCH_ASSOC);
    
         // On crée un tableau d'instances 
         $locataireList = array();
         foreach ($results as $result) {

            $locataireList[]= new Locataire($result['NomLocataire'], $result['PrenomLocataire'], $result['Adresse1Locataire'], $result['Adresse2Locataire'], $result['CodePostalLocataire'], $result['VilleLocataire'], $result['NumTel2Locataire'], $result['NumTel1Locataire'], $result['EmailLocataire']);
    
         }
    
         return $locataireList;
    }



    // Méthode pour ajouter un appartement dans la base de données
    public function addAppartment(Appartement $appartement) {
        // préparer la requête SQL pour insérer l'appartement dans la table APPARTEMENT
        $sql = "INSERT INTO APPARTEMENT (Categorie, Type, NbPersonnes, AdresseLocation, photo, Equipements, CodeTarif, Num) VALUES (:Categorie, :Type, :NbPersonnes, :AdresseLocation, :photo, :Equipements, :CodeTarif, :Num)";
        $stmt = $this->db->prepare($sql);
    // lier les valeurs des paramètres de la requête SQL
    $stmt->bindValue(':Categorie', $appartement->getCategorie());
    $stmt->bindValue(':Type', $appartement->getType());
    $stmt->bindValue(':NbPersonnes', $appartement->getNbPersonnes());
    $stmt->bindValue(':AdresseLocation', $appartement->getAdresseLocation());
    $stmt->bindValue(':photo', $appartement->getPhoto());
    $stmt->bindValue(':Equipements', $appartement->getEquipements());
    $stmt->bindValue(':CodeTarif', $appartement->getCodeTarif());
    $stmt->bindValue(':Num', $appartement->getNumProprietaire());

        $stmt->execute();
    }

    // Méthode pour modifier un appartement dans la base de données
    public function updateAppartement(Appartement $appartement,$numLocation) {
        // préparer la requête SQL pour insérer l'appartement dans la table APPARTEMENT
        $sql = "UPDATE APPARTEMENT SET Categorie=?, Type=?, NbPersonnes=?, AdresseLocation=?, photo=?, Equipements=?, CodeTarif=?, Num=? WHERE NumLocation=?";
        $stmt = $this->db->prepare($sql);
    // lier les valeurs des paramètres de la requête SQL
    $stmt->bindValue(1, $appartement->getCategorie());
    $stmt->bindValue(2, $appartement->getType());
    $stmt->bindValue(3, $appartement->getNbPersonnes());
    $stmt->bindValue(4, $appartement->getAdresseLocation());
    $stmt->bindValue(5, $appartement->getPhoto());
    $stmt->bindValue(6, $appartement->getEquipements());
    $stmt->bindValue(7, $appartement->getCodeTarif());
    $stmt->bindValue(8, $appartement->getNumProprietaire());
    $stmt->bindValue(9, $numLocation);

        $stmt->execute();
    }

    // Méthode pour supprimer un appartement de la base de données
    public function deleteAppartement($numLocation) {
        $stmt = $this->db->prepare('DELETE FROM APPARTEMENT WHERE NumLocation = ?');

        $stmt->bindValue(1, $numLocation);

        $stmt->execute();
    }

    /**
     * Récupère un appartement en fonction de son numero de location
     *
     * @param int $numLocation L'identifiant de l'appartement à récupérer
     * @return Appartement|false L'appartement correspondant, ou false si il n'existe pas
     */
    public function getAppartementByNumLocation($numLocation)
    {
        // On prépare la requête SQL
        $stmt = $this->db->prepare('SELECT * FROM APPARTEMENT WHERE NumLocation = ?');
        $stmt->bindValue(1, $numLocation);

        // On exécute la requête
        $stmt->execute();

        // On récupère le résultat de la requête
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si la requête a renvoyé un résultat, on crée une instance de Appartement avec les données de la base de données
        if ($result !== false) {
            global $bdd;
            $sql = "SELECT Nom,Prenom FROM PROPRIETAIRE WHERE Num = ?";
            $st = $bdd->prepare($sql);
            $st->bindValue(1, $result['Num']);
            $st->execute();
            $row = $st->fetch(PDO::FETCH_ASSOC);
            $nomProprio=$row['Nom'];
            $prenomProprio=$row['Prenom'];
            return new Appartement($result['Categorie'], $result['Type'], $result['NbPersonnes'], $result['AdresseLocation'], $result['photo'], $result['Equipements'], $result['CodeTarif'], $nomProprio, $prenomProprio);
    
        } else {
            return false;
        }
    }



    public function getAllAppartements()
{
     // On prépare la requête SQL
     $query = $this->db->query('SELECT * FROM appartement');
     
     // On récupère le résultat de la requête
     $results = $query->fetchAll(PDO::FETCH_ASSOC);

     // On crée un tableau d'instances 
     $appartList = array();
     foreach ($results as $result) {
        global $bdd;
        $sql = "SELECT Nom,Prenom FROM PROPRIETAIRE WHERE Num = ?";
        $st = $bdd->prepare($sql);
        $st->bindValue(1, $result['Num']);
        $st->execute();
        $row = $st->fetch(PDO::FETCH_ASSOC);
        $nomProprio=$row['Nom'];
        $prenomProprio=$row['Prenom'];
        $appartList[]= new Appartement($result['Categorie'], $result['Type'], $result['NbPersonnes'], $result['AdresseLocation'], $result['photo'], $result['Equipements'], $result['CodeTarif'], $nomProprio, $prenomProprio);

     }

     return $appartList;
}

}

global $bdd;
$Manager = new Manager($bdd);


?>