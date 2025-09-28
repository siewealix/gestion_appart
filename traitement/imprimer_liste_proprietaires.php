<?php

    require_once('../donnees/Connexion.php');
    require_once('dompdf/autoload.inc.php');

    global $bdd; // récupérer la connexion PDO à la base de données

    // récupérer la liste des propriétaires depuis la base de données
    $sql = "SELECT * FROM PROPRIETAIRE";
    $stmt = $bdd->query($sql);
    $proprietaires = $stmt->fetchAll(PDO::FETCH_ASSOC);

    use Dompdf\Dompdf;

    // générer le contenu HTML de la liste des propriétaires
    $html = "<head><style> table {
        border-collapse: collapse;
        border: 1px solid black;
      }
      
      th, td {
        border: 1px solid black;
        padding: 5px;
      } </style></head>";

    $html .= "<h1>Liste des propriétaires</h1>";
    $html .= "<table>";
    $html .= "<tr><th>Numéro</th><th>Nom</th><th>Prénom</th><th>Adresse</th><th>Téléphone</th><th>Email</th></tr>";
    foreach ($proprietaires as $proprietaire) {
        $html .= "<tr><td>{$proprietaire['Num']}</td><td>{$proprietaire['Nom']}</td><td>{$proprietaire['Prenom']}</td><td>{$proprietaire['Adresse1']}<br>{$proprietaire['CodePostal']} {$proprietaire['Ville']}</td><td>{$proprietaire['NumTel1']}</td><td>{$proprietaire['Email']}</td></tr>";
    }
    $html .= "</table>";

    // générer le PDF à partir du contenu HTML
    $pdf = new Dompdf();
    $pdf->loadHtml($html);
    $pdf->setPaper('A4', 'landscape');
    $pdf->render();

    // envoyer le PDF au navigateur pour l'affichage ou le téléchargement
    $pdf->stream('liste_proprietaires.pdf', array("Attachment" => 0));


?>