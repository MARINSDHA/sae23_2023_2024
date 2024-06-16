<!DOCTYPE html>
<html lang="fr">		<!-- Setting the language to french-->
	<head>
		<link rel="stylesheet" type="text/css" href="./styles/style.css" />	<!-- Line bindering HTML page with the CSS file-->
		<link rel="icon" type="image/png" href="../medias/favicon.png" /> 	<!-- Thumbnail on the tab of the website-->
		<title>SAÉ23 - Administration</title> 	<!-- Main title of the page-->
  	<meta charset="utf-8"> 	<!--Encoding format for characters-->
  	<meta name="viewport" content="width=device-width, initial-scale=1" /> 	<!-- This line is necessary to handle well RWD display-->
  	<meta name="author" content="MWM" />			<!--Referencing stuff : The autors-->
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
          <li><a href=" Administration.php" class="selected">Administration</a></li>
			  	<li><a href=" Gestion.php">Gestion</a></li>
			  	<li><a href=" Consultation.php">Consultation</a></li>
			  	<li><a href=" Contact.html">Contact</a></li>
			  	<li><a href=" Gestion_de_projet.html">Gestion de projet</a></li>
          <li><a href=" Mentions_legales.html"><i>Mentions légales</i></a></li>
        </ul>
      </nav>
      
    </header> 
    
  			<section class="text">
    			<h1>Ajout du batiment réussi</h1>
 			</section>
 			
			<section>
			<!-- Insert request in function of data sent by the chosebat.php form + "dynamic" displaying of building s data-->
				<?php
					include("db.php");
	
					// Get the values from the submitted form
					$name = $_POST['name'];
					$gest = $_POST['gest'];
	
					// Insert the values into the 'batiments' table
					$request = "INSERT INTO `Batiment` (`nom`, `login_gest`)
						VALUES ('$name', '$gest')";
					$result = mysqli_query($conn, $request)
						or die("Execution of the query $request failed");
					mysqli_close($conn);
	
					// Display the added building information
					echo '<div>';
					echo "<strong>Le bâtiment suivant a été ajouté:</strong>";
					echo "<ul>
							<li>Nom du bâtiment: $name</li>
							<li>Gestionnaire du bâtiment: $gest</li>
		  					</ul>
							 </div>";
?>
</section>

<!-- Redirect to chosebat.php and chosecapteur.php -->
<section>
	<form action="./chosebat.php" method="GET">
		<input type="submit" value="Gérer un autre bâtiment"/>
	</form>

	<form action="./chosecapteur.php" method="GET">
		<input type="submit" value="Gérer un capteur"/>
	</form>
</section>

 		<section class="bas_de_page">
			<hr>
  		<p><em> Validation de la page HTML5 - CSS3 </em></p>		<!-- HTML and CSS Validator-->
			<img class="Validation" src="./images/Validation_HTML.png" alt="HTML5 Valide !" /> 
			<img class="Validation" src="./images/vcss-blue.gif" alt="CSS Valide !"/>
			</section>
			
			<footer>
    		<ul>
      		<li> THIAM / FELLAH / LEVEIL </li>
      		<li><b>SAÉ 23</b></li>
      		<li><a href="https://www.iut-blagnac.fr/fr/" >IUT de Blagnac </a></li><!-- Link to the website of our dear school-->
    		</ul>  
  		</footer>
  			</div>
 		</body>
</html>
