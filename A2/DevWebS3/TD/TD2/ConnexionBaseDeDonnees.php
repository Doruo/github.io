<?php

use Configuration\ConfigurationBaseDeDonnees;

require_once 'ConfigurationBaseDeDonnees.php';

class ConnexionBaseDeDonnees{

    private static ?Modele\ConnexionBaseDeDonnees $instance = null;
    private PDO $pdo;

    public function __construct()
    {
        $nomHote = ConfigurationBaseDeDonnees::getNomHote();
        $port = ConfigurationBaseDeDonnees::getPort();
        $nomBaseDeDonnees = ConfigurationBaseDeDonnees::getNomBaseDeDonnees();
        $login = ConfigurationBaseDeDonnees::getLogin();
        $motDePasse = ConfigurationBaseDeDonnees::getMotDePasse();

        // Connexion à la base de données
        // Le dernier argument sert à ce que toutes les chaines de caractères
        // en entrée et sortie de MySql soit dans le codage UTF-8
        $this->pdo = new PDO("mysql:host=$nomHote;port=$port;dbname=$nomBaseDeDonnees", $login, $motDePasse,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

        // On active le mode d'affichage des erreurs, et le lancement d'exception en cas d'erreur
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getPdo() : PDO {
        return Modele\ConnexionBaseDeDonnees::getInstance()->pdo;
    }

    public static function getInstance() : Modele\ConnexionBaseDeDonnees{
        if (is_null(Modele\ConnexionBaseDeDonnees::$instance))
            Modele\ConnexionBaseDeDonnees::$instance = new Modele\ConnexionBaseDeDonnees();
        return Modele\ConnexionBaseDeDonnees::$instance;
    }
}