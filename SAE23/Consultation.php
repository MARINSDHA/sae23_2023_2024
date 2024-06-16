<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" type="text/css" href="./styles/style.css" />
    <link rel="stylesheet" type="text/css" href="./styles/tableau3.css" />
    <link rel="icon" type="image/png" href="./images/icon.png" />
    <title>SAÉ23 - Administration</title>
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
    <h1>Consultation des données</h1>
</section>

<section class="tableaux">
    <table>
        <thead>
            <tr>
                <th>Capteur</th>
                <th>Timestamp</th>
                <th>Valeur</th>
                <th>Unité</th>
            </tr>
        </thead>
        <tbody>
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

            // List of device names
            $devices = ['AM107-3', 'AM107-7', 'AM107-35', 'AM107-47'];

            // Fetch measurements for each device
            foreach ($devices as $device) {
                $sql = "
                    SELECT Mesure.date AS timestamp, Mesure.valeur, Capteur.unite
                    FROM Mesure
                    INNER JOIN Capteur ON Mesure.nom_capteur = Capteur.nom_capteur
                    WHERE Capteur.nom_capteur = '$device'
                    ORDER BY Mesure.date DESC, Mesure.horaire DESC
                    LIMIT 20
                ";
                
                // Execute query and check for errors
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    continue; // Skip to the next device if there's an error
                }

                if (mysqli_num_rows($result) > 0) {
                    // Output data of each row
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$device}</td>";
                        echo "<td>{$row['timestamp']}</td>";
                        echo "<td>{$row['valeur']}</td>";
                        echo "<td>{$row['unite']}</td>";
                        echo "</tr>";
                    }
                }
            }

            // Close connection
            mysqli_close($conn);
            ?>
        </tbody>
    </table>
</section>

<section class="bas_de_page">
    <hr />
    <p><em>Validation de la page HTML5 - CSS3</em></p>
    <img class="Validation" src="./images/Validation_HTML.png" alt="HTML5 Valide !" />
    <img class="Validation" src="./images/vcss-blue.gif" alt="CSS Valide !" />
</section>

<footer>
    <ul>
        <li>THIAM / FELLAH / LEVEIL</li>
        <li><b>SAÉ 23</b></li>
        <li><a href="https://www.iut-blagnac.fr/fr/">IUT de Blagnac</a></li>
    </ul>
</footer>
</body>
</html>
