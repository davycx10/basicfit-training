<!-- // bdd/bdd.php gère la connexion à la base de données -->



<?php

	try{
		$users = "admin";
		$pass = "myadmin";
		$bdd = new PDO ('mysql:host=localhost;dbname=fitconnect',$users,$pass);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch (PDOException $e){
		print "Erreur! :" . $e->getMessage() .
		"<br/>";
		die();
	}

?>