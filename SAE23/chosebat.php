<!DOCTYPE html>
<html lang="fr"> <!-- Setting the language to French -->
<head>
		<link rel="stylesheet" type="text/css" href="./styles/style.css" />
		<link rel="stylesheet" type="text/css" href="./styles/tableau3.css" />
		<link rel="icon" type="image/png" href="../medias/favicon.png" /> <!-- Thumbnail on the tab of the website -->
		<title>SAÉ23 - Administration</title> <!-- Main title of the page -->
		<meta charset="utf-8"> <!-- Encoding format for characters -->
		<meta name="viewport" content="width=device-width, initial-scale=1" /> <!-- This line is necessary to handle well RWD display -->
		<meta name="author" content="MWM" /> <!-- Referencing stuff: The authors -->
		<meta name="description" content="SAÉ23" /> <!-- Referencing stuff: Description of the content -->
		<meta name="keywords" content="HTML, CSS" /> <!-- Referencing stuff: Keywords -->
</head>
<!-- Beginning of the Web page -->
<body>
		<header>
				<img class="image-responsive logo" src="images/Logo_RT.png" alt="Logo RT" />
				<!-- Browsing menu through which we can surf between the pages of the website -->
				<nav>
						<ul>
								<li><a href="index.html">Accueil</a></li>
								<li><a href="Administration.php" class="selected">Administration</a></li>
								<li><a href="Gestion.php">Gestion</a></li>
								<li><a href="Consultation.php">Consultation</a></li>
								<li><a href="Contact.html">Contact</a></li>
								<li><a href="Gestion_de_projet.html">Gestion de projet</a></li>
								<li><a href="Mentions_legales.html"><i>Mentions légales</i></a></li>
						</ul>
				</nav>
		</header>

		<section class="text">
				<h1>Sélectionnez le bâtiment à supprimer ou entrez en un nouveau !</h1>
		</section>

		<section class="tableaux">
				<fieldset>
						<legend><strong>Liste des bâtiments</strong></legend>
						<!-- Table which displays every existing building data -->
<?php
include("db.php");

// Requête pour récupérer tous les enregistrements de la table 'batiments'
$request = "SELECT * FROM `Batiment`";
$result = mysqli_query($conn, $request) or die("Exécution de la requête $request impossible");

if (mysqli_num_rows($result) > 0) {
 	echo "<table><tr><th>Identifiant</th><th>Nom</th><th>Gestionnaire</th></tr>";
	// Boucle pour chaque enregistrement récupéré de la base de données
	while ($ligne = mysqli_fetch_assoc($result)) {
				echo "<tr><td>N°" . $ligne["identifiant_bat"] . "</td><td>" . $ligne["nom"] . "</td><td>" . $ligne["login_gest"] . "</td></tr>";
		}
	echo "</table";
} else {
	echo "Aucun bâtiment trouvé.";
}			
?>
				</fieldset>
		</section>

		<section>
				<!-- Form where you can choose between every building (displayed as "id / name") -->
				<form action="suppbat.php" method="post" enctype="multipart/form-data">
						<fieldset>
								<legend><strong>Supprimer un bâtiment</strong></legend>
							 <?php
include("db.php");

// Requête pour récupérer tous les champs de la table 'Batiments'
$request = "SELECT * FROM `Batiment`";
$result = mysqli_query($conn, $request) or die("Exécution de la requête $request impossible");
?>
<div class="tab">
		<label for="id">Id/Nom de votre bâtiment à supprimer : </label>
		<select name="id">
				<?php
				// Boucle pour chaque enregistrement récupéré de la base de données
				while ($ligne = mysqli_fetch_array($result)) {
						echo "<option value='" . $ligne['identifiant_bat'] . "'>" . $ligne['identifiant_bat'] . " / ". $ligne['nom'] . "</option>";
				}
				?>
								<div class="valid">
										<input type="submit" value="Supprimer">
								</div>
						</fieldset>
				</form>

				<!-- Form where you can enter the name and choose the administrator of the building to create a new building -->
				<form action="addbat.php" method="post" enctype="multipart/form-data">
						<fieldset>
								<legend><strong>Ajouter un bâtiment</strong></legend>
								<label for="name">Nom du bâtiment</label>
								<input type="text" name="name" id="name" />
								<br />
								<?php
										include("db.php");

										// Query to retrieve the 'login' field from the 'batiments' table
										$request = "SELECT `login_gest` FROM `Batiment`";
										$result = mysqli_query($conn, $request) or die("Execution de la requête $request impossible");
										mysqli_close($conn);

										// Display a label and a dropdown select menu
										echo '<label for="bat">Gestionnaire de votre bâtiment : </label>';
										echo '<select name="gest">';

										// Loop through each record retrieved from the database
										while ($ligne = mysqli_fetch_array($result)) {
												// Create an option element for each login value
												echo "<option value='$ligne[login_gest]'>$ligne[login_gest]</option>";
										}
										echo '</select>';
								?>
								<div class="valid">
										<input type="submit" value="Ajouter" />
								</div>
						</fieldset>
				</form>
		</section>
		<section class="bas_de_page">
				<hr>
				<p><em>Validation de la page HTML5 - CSS3</em></p> <!-- HTML and CSS Validator -->
				<img class="Validation" src="./images/Validation_HTML.png" alt="HTML5 Valide !" /> 
				<img class="Validation" src="./images/vcss-blue.gif" alt="CSS Valide !" />
		</section>

		<footer>
				<ul>
						<li>THIAM / FELLAH / LEVEIL</li>
						<li><b>SAÉ 23</b></li>
						<li><a href="https://www.iut-blagnac.fr/fr/">IUT de Blagnac</a></li> <!-- Link to the website of our dear school -->
				</ul>
		</footer>
</body>
</html>
