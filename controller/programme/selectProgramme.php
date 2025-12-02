<!-- // controller/programme/selectProgramme.php
// Permet de récupérer tous les programmes -->

<?php

include('bdd/bdd.php');
include('model/programme/programmeModel.php');

$programme = new Programme($bdd);
$allProgramme = $programme->allProgramme();

?>