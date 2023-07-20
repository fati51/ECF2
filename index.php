<?php

$servername = "localhost";
$username = "u379183731_root";
$password = "Khadidja69@";
$dbname = "u379183731_jeux";

try {
    
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer les publications depuis la base de données
    $sql = "SELECT * FROM publications ORDER BY date_publication DESC";
    $result = $pdo->query($sql);

    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Page d'accueil</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
            .card-development {
                position: relative;
            }

            .card-development::after {
                content: "En développement";
                position: absolute;
                top: 10px;
                right: 10px;
                background-color: #f44336;
                color: white;
                padding: 5px 10px;
                font-size: 12px;
                border-radius: 5px;
            }

            .card-img-fixed-height {
                height: 200px; 
                object-fit: cover;
            }

            .card-margin {
                margin-bottom: 20px; 
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #747e88;">
            <div class="container">
                <a class="navbar-brand" href="index.php"><img src="./Images/logo jeuxvideo.png" alt="GameSoft Logo" width="60"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="connexion.php">Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="recupe_jeu.php">Tous les jeux</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="description.html">Qui nous sommes</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <h1>Bienvenue chez GameSoft</h1>
            <p>Studio de jeu vidéo français spécialisé dans les RPG</p>
            <h2>Dernières actualités</h2>

            <?php
            if ($result->rowCount() > 0) {
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo '<div class="news-item">';
                    echo '<p>'.$row["contenu"].'</p>';
                    echo '</div>';
                }
            } else {
                echo "Aucune publication trouvée.";
            }
            ?>

       

            <?php
            $sql = "SELECT * FROM jeux WHERE statut = 'en cour'";
            $stmt = $pdo->query($sql);

            if ($stmt->rowCount() > 0) {
                echo '<div class="container">';
                echo '<div class="row">';
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $titre = $row['titre'];
                    $dateFin = $row['date_fin'];
                    $cheminImage = $row['galerie_images'];
                    $description = $row['description'];
                    ?>
                    <div class="col-md-6 card-margin">
                        <div class="card card-development">
                            <img src="<?php echo $cheminImage; ?>" class="card-img-top card-img-fixed-height" >
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $titre?></h5>
                              
                            </div>
                        </div>
                    </div>
                    <?php
                }
                echo '</div>';
                echo '</div>';
            } else {
                echo "Aucun jeu en cours trouvé.";
            }
            ?>
        </div>

    </body>
    </html>
    <?php
    
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>