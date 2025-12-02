<!-- // controller/coach/selectCoach.php
// Permet de récupérer tous les coachs -->

<?php

include('bdd/bdd.php');
include('model/coach/coachModel.php');

$coach = new Coach($bdd);
$allCoach = $coach->allCoach();

?>