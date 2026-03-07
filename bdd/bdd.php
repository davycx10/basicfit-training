<!-- // bdd/bdd.php gère la connexion à la base de données -->



<?php

	try{
		// sur pc perso user = admin, pass = myadmin
		// pc  user = adminphp, pass = (vide)
		$users = "adminphp";
		$pass = "";
		$bdd = new PDO ('mysql:host=localhost;dbname=fitconnect',$users,$pass);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch (PDOException $e){
		print "Erreur! :" . $e->getMessage() .
		"<br/>";
		die();
	}

?>