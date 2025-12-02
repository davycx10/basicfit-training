<!-- 
    controller/utilisateur/selectUtilisateur.php
    Permet de récupérer tous les utilisateurs
 -->

<?php

include('bdd/bdd.php');
include('model/utilisateur/utilisateurModel.php');

$utilisateur = new Utilisateur($bdd);
$allUtilisateur = $utilisateur->allUtilisateur();

?>