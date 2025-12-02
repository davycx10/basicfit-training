<!-- // controller/programme/selectProgrammeById.php
// Permet de récupérer un programme spécifique par son ID -->

<?php

include('bdd/bdd.php');
include('model/programme/programmeModel.php');

$programme = new Programme($bdd);
$programmeById = $programme->selectById($_GET['id_programme']);

?>