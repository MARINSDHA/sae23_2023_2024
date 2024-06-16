<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" type="text/css" href="./styles/style.css" />
    <link rel="stylesheet" type="text/css" href="./styles/tableau3.css" />
    <link rel="icon" type="image/png" href="./images/icon.png" />
    <title>SAÉ23 - Gestion</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="SCM" />
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
    <h1>Espace Gestionnaire</h1>
    <h2>Consultation des capteurs</h2>
    <?php
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "sae23";
    $dbname = "sae23";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get logged-in user from session (assuming you've set this up after authentication)
    session_start();
    if (isset($_SESSION['utilisateurConnecte'])) {
        $user = $_SESSION['utilisateurConnecte'];
    } else {
        echo "Utilisateur non connecté.";
        exit();
    }

    // Fetch building information for the logged-in user
    $sql_user = "SELECT identifiant_bat FROM Batiment WHERE login_gest = '$user'";
    $result_user = mysqli_query($conn, $sql_user);

    if ($result_user && mysqli_num_rows($result_user) > 0) {
        $row_user = mysqli_fetch_assoc($result_user);
        $building = $row_user['identifiant_bat'];

        // Fetch sensors for the building
        $sql_sensors = "
            SELECT Capteur.nom_capteur, Capteur.unite
            FROM Capteur
            INNER JOIN Salle ON Capteur.nom_salle = Salle.nom_salle
            WHERE Salle.identifiant_bat = '$building'
        ";
        $result_sensors = mysqli_query($conn, $sql_sensors);

        if ($result_sensors && mysqli_num_rows($result_sensors) > 0) {
            echo '<section class="tableaux">';
            echo '<h2>Dernières mesures des capteurs</h2>';
            echo '<table>';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Capteur</th>';
            echo '<th>Moyenne</th>';
            echo '<th>Min</th>';
            echo '<th>Max</th>';
            echo '<th>Unité</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($row_sensor = mysqli_fetch_assoc($result_sensors)) {
                $sensor = $row_sensor['nom_capteur'];
                $sql_measurements = "
                    SELECT 
                        AVG(valeur) AS moyenne,
                        MIN(valeur) AS min_val,
                        MAX(valeur) AS max_val
                    FROM Mesure
                    WHERE nom_capteur = '$sensor'
                    ORDER BY date DESC, horaire DESC
                    LIMIT 10
                ";
                $result_measurements = mysqli_query($conn, $sql_measurements);

                if ($result_measurements && mysqli_num_rows($result_measurements) > 0) {
                    $row_measurement = mysqli_fetch_assoc($result_measurements);
                    echo '<tr>';
                    echo '<td>' . $sensor . '</td>';
                    echo '<td>' . $row_measurement['moyenne'] . '</td>';
                    echo '<td>' . $row_measurement['min_val'] . '</td>';
                    echo '<td>' . $row_measurement['max_val'] . '</td>';
                    echo '<td>' . $row_sensor['unite'] . '</td>';
                    echo '</tr>';
                }
            }

            echo '</tbody>';
            echo '</table>';
            echo '</section>';
        } else {
            echo "Aucun capteur trouvé pour le bâtiment.";
        }
    } else {
        echo "Aucun bâtiment trouvé pour l'utilisateur.";
    }

    // Close connection
    mysqli_close($conn);
    ?>
</section>

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

</body>
</html>
