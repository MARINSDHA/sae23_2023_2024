   <!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" type="text/css" href="./styles/style.css" />
    <link rel="stylesheet" type="text/css" href="./styles/tableau3.css" />
    <link rel="icon" type="image/png" href="./images/icon.png" />
    <title>SAÉ23 - Gestion</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="MWM" />
    <meta name="description" content="SAÉ23" />
    <meta name="keywords" content="HTML, CSS" />
</head>
<body>
<header>
    <img class="image-responsive logo" src="images/Logo_RT.png" alt="Logo RT" />
    <nav>
        <ul>
            <li><a href="index.html">Accueil</a></li>
            <li><a href="Administration.php">Administration</a></li>
            <li><a href="Gestion.php" class="selected">Gestion</a></li>
            <li><a href="Consultation.php">Consultation</a></li>
            <li><a href="Contact.html">Contact</a></li>
            <li><a href="Gestion_de_projet.html">Gestion de projet</a></li>
            <li><a href="Mentions_legales.html"><i>Mentions légales</i></a></li>
        </ul>
    </nav>
</header>

<section class="text">
    <h1>Affichage des mesures</h1>
</section>

<section class="tableaux">
    <?php
    include("db.php");// Include the database connection file

    if (isset($_POST['capteur'])) {
        $capteurSelectionne = $_POST['capteur'];
        $dateDebut = $_POST['dateDebut'];
        $dateFin = $_POST['dateFin'];
        $heureDebut = $_POST['heureDebut'];
        $heureFin = $_POST['heureFin'];

        // Convert values to formats compatible with the database
        $dateDebutFormat = date('Y-m-d', strtotime($dateDebut));
        $dateFinFormat = date('Y-m-d', strtotime($dateFin));
        $heureDebutFormat = date('H:i:s', strtotime($heureDebut));
        $heureFinFormat = date('H:i:s', strtotime($heureFin));

         // Query to retrieve measurements of the selected sensor within the specified date and time range
        $requeteMesures = "SELECT * FROM `mesure` WHERE `ID-cap` = '$capteurSelectionne' AND `date` BETWEEN '$dateDebutFormat' AND '$dateFinFormat' AND `heure` BETWEEN '$heureDebutFormat' AND '$heureFinFormat'";
        $resultatMesures = mysqli_query($conn, $requeteMesures);
        
        // Retrieve the room associated with the sensor
		$requeteSalle = "SELECT `Salle` FROM `mesure` WHERE `ID-cap` = '$capteurSelectionne' LIMIT 1";
		$resultatSalle = mysqli_query($conn, $requeteSalle);
		$salle = mysqli_fetch_assoc($resultatSalle)['Salle'];




         // Check if any measurements were found
        if (mysqli_num_rows($resultatMesures) > 0) {
            echo '<h2>Mesures du capteur '.$capteurSelectionne.' - Salle '.$salle.'</h2>';
            echo '<table>';
            echo '<thead><tr><th>Type</th><th>Date</th><th>Heure</th><th>Valeur</th></tr></thead>';
            echo '<tbody>';
			
			
			
           // Display the measurements
            while ($mesure = mysqli_fetch_assoc($resultatMesures)) {
            	$type = $mesure['type'];
				include("unite.php");
			
                echo '<tr>';
                echo '<td>'.$mesure['type'].'</td>';
                echo '<td>'.$mesure['date'].'</td>';
                echo '<td>'.$mesure['heure'].'</td>';
                echo '<td>'.$mesure['valeur'].$unit.'</td>';
                echo '</tr>';
            }

            echo '</tbody></table>';
        } else {
            echo 'Aucune mesure trouvée pour le capteur '.$capteurSelectionne.' dans la plage de dates et horaires spécifiée.';
        }

        // Close the database connection
        mysqli_close($conn);
    } else {
        echo 'Aucun capteur sélectionné.';
    }
    ?>

    <br>
    <form action="./gest.php" method="GET">
        <input type="submit" value="Visualiser un autre capteur" />
    </form>
</section>

<section class="bas_de_page">
    <hr>
    <p><em>Validation de la page HTML5 - CSS3</em></p>
    <img class="Validation" src="./images/Validation_HTML.png" alt="HTML5 Valide !" />
    <img class="Validation" src="./images/vcss-blue.gif" alt="CSS Valide !" />
    <footer>
        <ul>
            <li>THIAM / FELLAH / LEVEIL</li>
            <li><b>SAÉ 23</b></li>
            <li><a href="https://www.iut-blagnac.fr/fr/">IUT de Blagnac</a></li>
        </ul>
    </footer>
</section>
</body>
</html>
