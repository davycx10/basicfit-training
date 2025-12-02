<!--  
  controller/client/selectClient.php
  Permet de récupérer tous les clients pour les afficher dans une liste ou un tableau
  -->


<?php

include('bdd/bdd.php');
include('model/client/clientModel.php');

$client = new Client($bdd);
$allClients = $client->allClients();

?>