<?php
	#login to the database by using login/password + using of the base final
    $conn = mysqli_connect("localhost", "root", "sae23", "sae23")
		or die("Connexion au serveur/à la base de données impossible");
		
	// Set the character set of the database connection to UTF-8	
	mysqli_query($conn, "SET NAMES 'utf8'");

?>
