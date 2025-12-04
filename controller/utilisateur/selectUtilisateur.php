
<!-- 
    controller/utilisateur/selectUtilisateur.php
    Permet de récupérer tous les utilisateurs pour affichage (liste / admin)
-->

<?php

// Charge la connexion à la base de données (PDO)
// Le fichier définit la variable $bdd utilisée par le model
include('bdd/bdd.php');

// Charge le model Utilisateur qui contient les méthodes CRUD
include('model/utilisateur/utilisateurModel.php');

// Instancie le model Utilisateur en lui passant la connexion BDD
$utilisateur = new Utilisateur($bdd);

// Appelle la méthode allUtilisateur() du model pour récupérer
// la liste complète des utilisateurs depuis la base de données.
// Résultat : tableau d'objets / tableaux associatifs.
$allUtilisateur = $utilisateur->allUtilisateur();

?>