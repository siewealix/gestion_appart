<?php 

require_once('../donnees/Connexion.php');
require_once('dompdf/autoload.inc.php');

    // récupérer la liste des locataires depuis la base de données
    global $bdd;
    $sql = "SELECT * FROM LOCATAIRE";
    $stmt = $bdd->prepare($sql);
    $stmt->execute();
    $locataires = $stmt->fetchAll(PDO::FETCH_ASSOC);

    use Dompdf\Dompdf;
    
    $html = "<head><style> table {
        border-collapse: collapse;
        border: 1px solid black;
      }
      
      th, td {
        border: 1px solid black;
        padding: 5px;
      } </style></head>";
      
    $html .= '<h1>Liste des locataires</h1>';
    $html .= '<table>';
    $html .= '<tr><th>Numéro</th><th>Nom</th><th>Prénom</th><th>Adresse</th><th>Téléphone</th><th>Email</th></tr>';
    foreach ($locataires as $locataire) {
        $html .= '<tr>';
        $html .= '<td>' . $locataire['NumLocataire'] . '</td>';
        $html .= '<td>' . $locataire['NomLocataire'] . '</td>';
        $html .= '<td>' . $locataire['PrenomLocataire'] . '</td>';
        $html .= '<td>' . $locataire['Adresse1Locataire'] . ', ' . $locataire['Adresse2Locataire'] . ', ' . $locataire['CodePostalLocataire'] . ' ' . $locataire['VilleLocataire'] . '</td>';
        $html .= '<td>' . $locataire['NumTel1Locataire'] . '</td>';
        $html .= '<td>' . $locataire['EmailLocataire'] . '</td>';
        $html .= '</tr>';
    }
    $html .= '</table>';
    $pdf = new Dompdf();
    $pdf->loadHtml($html);
    $pdf->setPaper('A4', 'landscape');
    $pdf->render();
    $pdf->stream("liste_locataires.pdf", array("Attachment" => 0));

?>