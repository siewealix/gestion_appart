<?php

class Connexion {
    private $host = 'localhost';
    private $dbname = 'gesap';
    private $username = 'root';
    private $password = '';
    private $bdd;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        try {
            $this->bdd = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Erreur de connexion à la base de données: " . $e->getMessage();
            die();
        }
    }

    public function getBdd() {
        return $this->bdd;
    }
}

// Créer une instance de la classe Connexion pour se connecter à la base de données
$connexion = new Connexion();
$bdd = $connexion->getBdd();

?>