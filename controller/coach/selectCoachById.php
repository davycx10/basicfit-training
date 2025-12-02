<!-- // controller/coach/selectCoachById.php
// Permet de récupérer un coach spécifique par son ID -->

<?php

include('bdd/bdd.php');
include('model/coach/coachModel.php');

$coach = new Coach($bdd);
$coachById = $coach->selectById($_GET['id_coach']); // ou $_POST selon l'appel

?>