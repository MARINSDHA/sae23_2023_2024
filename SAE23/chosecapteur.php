<?php
	session_start();
		if ($_SESSION["auth"]!=TRUE)
			header("Location:logfail.php");
?>

<!DOCTYPE html>
<html lang="fr">		<!-- Setting the language to french-->
	<head>
		<link rel="stylesheet" type="text/css" href="./styles/style.css" />  <!-- Line bindering HTML page with the CSS file-->
		<link rel="stylesheet" type="text/css" href="./styles/tableau3.css" />
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
    		<h1>Sélectionnez le capteur à supprimer ou entrez en un nouveau !</h1>
 		</section>
 		<section class="tableaux">
		<fieldset> 			
		<legend><strong> Liste des capteurs </strong></legend>
			<!-- table which display every existing sensor data-->
 			<?php
 				include("db.php");
 				
 				// Query to retrieve all fields from the 'Capteur' table
 				$request = "SELECT * FROM `Capteur`";
 				$result = mysqli_query($conn, $request)
 					or die("Execution de la requete $request impossible");

 				// Output the table structure
				echo '<table>';
				echo '<tr><th>Identifiant capteur</th><th>Nom</th><th>Batiment</th></tr>';
				
				// Loop through each record retrieved from the database
 				while($ligne=mysqli_fetch_assoc($result))
 				{
 				 // Extracting the associative array values into individual variables
 					extract($ligne);
 					
 					 // Outputting a table row with the sensor ID, name, and building ID
					echo "<tr><td>".$ligne["nom_capteur"]."</td><td>$nom</td><td>".$ligne["nom_capteur"]."</td></tr>";
 				}
 				
 				// Close the table structure
				echo '</table>';

 			?>
			</fieldset> 			
		</section>	
<section>
    <!-- form where you can chose between every sensor (displayed as "id / name")-->	
    <form action="suppcapteur.php" method="post" enctype="multipart/form-data">
        <fieldset> 			
            <legend><strong> Supprimer un capteur</strong> </legend>
            <?php
                include("db.php");
                
                // Query to retrieve all fields from the 'capteur' table
                $request = "SELECT * FROM `Capteur`";
                $result = mysqli_query($conn, $request)
                    or die("Execution de la requete $request impossible");
                    
                // Close the database connection
                mysqli_close($conn);
                
                 // Output the select element within a div
                echo '<div class="tab">';
                echo '<label for="id"> Id/Nom du votre capteur à supprimer : </label>';
                echo '<select name="id">';
                
                
                 // Loop through each record retrieved from the database    
                while($ligne=mysqli_fetch_array($result))
                {	
                	// Extracting the associative array values into individual variables
                    extract($ligne);
                    
                    // Outputting an option with the sensor ID, name, and formatted text
                    echo "<option value='".$ligne['nom_capteur']."'> ".$ligne["nom_capteur"]." / $nom </option>";
                }
                
                 // Close the select element and the div
                echo '</select>';
                echo '</div>';
            ?>
            <div class="valid">
                <input type="submit" value="Supprimer">
            </div>
        </fieldset> 
    </form>
    
    <!-- form where you can enter the name and chose the type of the sensor + the building where the sensor is in order to create a new sensor-->						 
    <form action="addcapteur.php" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend><strong> Ajouter un capteur</strong> </legend>
            <label for="name"> Nom du capteur </label>
            <input type="text" name="name" id="name" />
            
            <?php
                include("db.php");
                $request = "SELECT `identifiant_bat` FROM `Batiment`";
                $result = mysqli_query($conn, $request)
                    or die("Execution de la requete $request impossible");
                mysqli_close($conn);
                
                echo '<div class="tab">';
                echo '<label for="bat">Batiment de votre capteur : </label>';
                echo '<select name="bat">';
                
                while($ligne=mysqli_fetch_array($result))
                {
                    extract($ligne);
                    echo "<option value='".$ligne['identifiant_bat']."'> ".$ligne['identifiant_bat']. "</option>";						
                }
                echo '</select>';
                echo '</div>';
            ?>

            <div class="valid">
                <input type="submit" value="Ajouter" />
            </div>
        </fieldset>
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
 </body>
</html>
