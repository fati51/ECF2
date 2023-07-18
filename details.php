<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "gamesoft";

try {
    
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    if (isset($_GET['id_jeu'])) {
        $id = $_GET['id_jeu'];

        
        $sql = "SELECT * FROM jeux WHERE id_jeu = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $titre = $row['titre'];
            $dateFin = $row['date_fin'];
            $cheminImage = $row['galerie_images'];
            $description = $row['description'];
            $support = $row['support'];
            $type = $row['type'];
            $nomStudio = $row['nom_studio'];
            $poids = $row['poids'];
            $score = $row['score'];
            $moteur = $row['moteur'];
            $dateDebut = $row['date_debut'];
            $dateMiseAJour = $row['date_mise_a_jour'];
            $dateEstimee = $row['date_estimee'];
            $statut = $row['statut'];
            ?>
            <!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Détails du jeu</title>
                <link rel="stylesheet" href="style.css">
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            </head>
            <body>
            <div class="container">
                <h1>Détails du jeu</h1>
                <div class="card">
                    <img src="<?php echo $cheminImage; ?>" class="card-img-top" alt="<?php echo $titre; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $titre; ?></h5>
                        <p class="card-text">Nom du studio : <?php echo $nomStudio; ?></p>
                        <p class="card-text">Poids : <?php echo $poids; ?></p>
                        <p class="card-text">Score : <?php echo $score; ?></p>
                        <p class="card-text">Moteur : <?php echo $moteur; ?></p>
                        <p class="card-text">Date de création : <?php echo $dateDebut; ?></p>
                        <p class="card-text">Date de dernière mise à jour : <?php echo $dateMiseAJour; ?></p>
                        <p class="card-text">Date estimée de fin : <?php echo $dateEstimee; ?></p>
                        <p class="card-text">Statut : <?php echo $statut; ?></p>
                        <p class="card-text">Support : <?php echo $support; ?></p>
                        <p class="card-text">Type : <?php echo $type; ?></p>
                        <p class="card-text"><?php echo $description; ?></p>
                        <a href="recupe_jeu.php" class="btn btn-danger">Retour</a>
                    </div>
                </div>
            </div>

            </body>
            </html>
            <?php
        } else {
            echo "Jeu non trouvé.";
        }
    } else {
        echo "Identifiant de jeu non spécifié.";
    }
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>
