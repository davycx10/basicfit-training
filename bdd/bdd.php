<!-- // bdd/bdd.php gère la connexion à la base de données -->

<?php

try {
    $users = "admin";  // put your database username here
    $pass = "myadmin";   // put your database password here
    $bdd = new PDO("mysql:host=localhost;dbname=fitconnect;charset=utf8", $users, $pass);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur ! : " . $e->getMessage() . "<br/>";
    die();
}

?>