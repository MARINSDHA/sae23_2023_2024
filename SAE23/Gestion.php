<!DOCTYPE html>
<html lang="fr">		<!-- Setting the language to french-->
	<head>
  	<link rel="stylesheet" type="text/css" href="./styles/style.css" />		<!-- Line bindering HTML page with the CSS file-->
  	<link rel="icon" type="image/png" href="./images/icon.png" />		<!-- Thumbnail on the tab of the website-->
  	<title>SAÉ23 - Gestion</title>		<!-- Main title of the page-->
  	<meta charset="utf-8">		 	<!--Encoding format for characters-->
  	<meta name="viewport" content="width=device-width, initial-scale=1" /> 		<!-- This line is necessary to handle well RWD display-->
  	<meta name="author" content="MWM" />		<!--Referencing stuff : The autors-->
  	<meta name="description" content="SAÉ23" /> 		<!--Referencing stuff : Description of the content-->
  	<meta name="keywords" content="HTML, CSS" />		<!--Referencing stuff : Keywords-->
	</head>
	<!--Beginning of the Web page-->
	<body>
  	<header>
  		<img class= image-responsive logo src=images/Logo_RT.png alt=Logo RT  />
  		<!-- Browsing menu thaks to which we can surf between the pages of the website-->
  		<nav>
    		<ul>
      				<li><a href=" index.html">Accueil</a></li>
      				<li><a href="Administration.php" >Administration</a></li>
					<li><a href=" Gestion.php" class="selected">Gestion</a></li>
					<li><a href="Consultation.php">Consultation</a></li>
					<li><a href="Contact.html">Contact</a></li>
					<li><a href=" Gestion_de_projet.html">Gestion de projet</a></li>
					<li><a href="Mentions_legales.html"><i>Mentions légales</i></a></li>
    		</ul>
    	</nav>
    	
		</header>   
		<section class="text">
			<h1>Espace Gestionnaire </h1>
    	<h2>Consultation des capteurs</h2>
    	<?php
    require 'db.php'; // Include the database connection file

    // Check the login credentials
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

         // SQL query to retrieve the matching username and password
        $sql = "SELECT * FROM Batiment WHERE login_gest = '$username' AND mdp_gest = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Credentials are valid
            
			
			
			// Get the information of the logged-in user
    $utilisateur = $result->fetch_assoc();

    // Store the logged-in user in a variable
    $utilisateurConnecte = $utilisateur['login_gest'];
    session_start();
	$_SESSION['utilisateurConnecte'] = $utilisateurConnecte;
    
            // Redirect to the buildings page
            header("Location: gest.php");
            exit();
        } else {
             // Invalid credentials
            echo "Identifiants invalides. Veuillez réessayer.";
        }
    }
    ?>
		</section>
		<section class="container">
        <h4>Connexion</h4>
        <form action="" method="post">
            <input type="text" name="username" placeholder="Nom d'utilisateur" required><br>
            <input type="password" name="password" placeholder="Mot de passe" required><br>
            <form method="POST" action="gest.php">
            <input type="submit" value="Se connecter">
            
        </form> 
    </section> 
		
			<hr>

  		<p><em> Validation de la page HTML5 - CSS3 </em></p>		<!-- HTML and CSS Validator-->
			<img class="Validation" src="./images/Validation_HTML.png" alt="HTML5 Valide !" /> 
			<img class="Validation" src="./images/vcss-blue.gif" alt="CSS Valide !"/>
			<footer>
    		<ul>
      		<li> THIAM / FELLAH / LEVEIL </li>
      		<li><b>SAÉ 23</b></li>
      		<li><a href="https://www.iut-blagnac.fr/fr/" >IUT de Blagnac </a><!-- Link to the website of our dear school-->
    		</ul>  
  		</footer>
  	
 	</body>
</html>
