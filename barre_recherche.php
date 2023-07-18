<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "gamesoft";


$query = $_GET['query'] ?? '';
$critere = $_GET['critere'] ?? '';

try {
    
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   
    $sql = "SELECT * FROM jeux WHERE 1=1";

    if (!empty($query) && !empty($critere)) {
        if ($critere === 'nom') {
            $sql .= " AND $critere LIKE '$query%'";
        } else {
            $sql .= " AND $critere = '$query'";
        }
    }

   
    $stmt = $pdo->query($sql);

    
    if ($stmt->rowCount() > 0) {
        echo '<div class="row">';
       
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="col-md-6">';
            echo '<div class="card">';
            echo '<img src="' . $row['galerie_images'] . '" alt="' . $row['titre'] . '" class="card-img-top">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $row['titre'] . '</h5>';
            echo '<p class="card-text">Date de fin : ' . $row['date_fin'] . '</p>';
            echo '<p class="card-text">Support : ' . $row['support'] . '</p>';
            echo '<p class="card-text">Type : ' . $row['type'] . '</p>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<p>Aucun résultat trouvé.</p>';
    }
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>


