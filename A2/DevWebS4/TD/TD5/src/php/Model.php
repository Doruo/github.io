<?php

require_once('Conf.php');

class Model {

    public static $pdo;

    public static function init_pdo() {
        $host   = Conf::getHostname();
        $dbname = Conf::getDatabase();
        $login  = Conf::getLogin();
        $pass   = Conf::getPassword();
        try {
            // connexion à la base de données
            // le dernier argument sert à ce que toutes les chaines de charactères
            // en entrée et sortie de MySql soit dans le codage UTF-8
            self::$pdo = new PDO("mysql:host={$host};port=3306;dbname={$dbname};", $login, $pass);
            // on active le mode d'affichage des erreurs, et le lancement d'exception en cas d'erreur
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die("Problème lors de la connexion à la base de données.");
        }
    }

    public static function selectByName($name) {
        try {
            // préparation de la requête
            $sql = "SELECT * FROM villes.cities WHERE name LIKE :name_tag LIMIT 10";
            $req_prep = self::$pdo->prepare($sql);
            // passage de la valeur de name_tag
            $values = array("name_tag" => $name."%");
            // exécution de la requête préparée
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_OBJ);
            // renvoi du tableau de résultats
            return $req_prep->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Erreur lors de la recherche dans la base de données.");
        }
    }

}

// on initialise la connexion $pdo
Model::init_pdo();
