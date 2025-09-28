<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<?php
require_once 'Connexion.php'; // inclure le fichier de connexion à la base de données
//require_once 'dompdf/autoload.php';

class Tarif {
    // attributs de la classe Tarif
    private $codeTarif;
    private $prixSemHS;
    private $prixSemBS;

    // constructeur de la classe Tarif
    public function __construct($codeTarif, $prixSemHS, $prixSemBS) {
        $this->codeTarif = $codeTarif;
        $this->prixSemHS = $prixSemHS;
        $this->prixSemBS = $prixSemBS;
    }

    // getters et setters pour les attributs de la classe Tarif
    public function getCodeTarif() {
        return $this->codeTarif;
    }

    public function setCodeTarif($codeTarif) {
        $this->codeTarif = $codeTarif;
    }

    public function getPrixSemHS() {
        return $this->prixSemHS;
    }

    public function setPrixSemHS($prixSemHS) {
        $this->prixSemHS = $prixSemHS;
    }

    public function getPrixSemBS() {
        return $this->prixSemBS;
    }

    public function setPrixSemBS($prixSemBS) {
        $this->prixSemBS = $prixSemBS;
    }

    // fonction pour ajouter un tarif à la base de données
    public function ajouterTarif() {
        global $bdd; // récupérer la connexion PDO à la base de données

        // préparer la requête SQL pour insérer un nouveau tarif dans la table TARIF
        $sql = "INSERT INTO TARIF (CodeTarif, PrixsemHS, PrixSemBS) VALUES (?, ?, ?)";
        $stmt = $bdd->prepare($sql);
        $stmt->bindValue(1, $this->codeTarif);
        $stmt->bindValue(2, $this->prixSemHS);
        $stmt->bindValue(3, $this->prixSemBS);

        // exécuter la requête SQL pour insérer le nouveau tarif dans la base de données
        if($stmt->execute()){
            echo '<div class="alert alert-success" role="alert">Tarif crée avec succès.</div>';
        } 
        else{
            echo "Erreur lors de la création de ce tarif. ";
        }
    }

    public function imprimerListeTarifs() {
        global $bdd; // récupérer la connexion PDO à la base de données

        // préparer la requête SQL pour récupérer la liste des tarifs dans la table TARIF
        $sql = "SELECT * FROM TARIF";
        $stmt = $bdd->prepare($sql);
        $stmt->execute();
        $tarifs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // construire le contenu HTML pour la liste des tarifs
        $html = "<html><head><style>table { border-collapse: collapse; width: 100%; } th, td { text-align: left; padding: 8px; } th { background-color: #4CAF50; color: white; }</style></head><body>";
        $html .= "<h1>Liste des tarifs</h1>";
        $html .= "<table>";
        $html .= "<tr><th>CodeTarif</th><th>PrixsemHS</th><th>PrixSemBS</th></tr>";
        foreach ($tarifs as $tarif) {
            $html .= "<tr><td>" . $tarif['CodeTarif'] . "</td><td>" . $tarif['PrixsemHS'] . "</td><td>" . $tarif['PrixSemBS'] . "</td></tr>";
        }
        $html .= "</table></body></html>";

        // générer le PDF à partir du contenu HTML
        $dompdf = new Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // afficher le PDF dans le navigateur ou le télécharger
        $dompdf->stream("liste_tarifs.pdf", array("Attachment" => false));
    }
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>      