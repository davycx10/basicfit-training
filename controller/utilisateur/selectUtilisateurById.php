<!-- 
    controller/utilisateur/selectUtilisateurById.php
    Permet de récupérer un utilisateur spécifique par son ID 
-->

<?php
// Récupère un utilisateur spécifique par son ID passé en paramètre GET
include('bdd/bdd.php');
include('model/utilisateur/utilisateurModel.php');

$utilisateur = new Utilisateur($bdd);
$utilisateurById = $utilisateur->selectById($_GET['id_utilisateur']);

?>