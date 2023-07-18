<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "gamesoft";

try {
    
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    $sql = "SELECT * FROM jeux";
    $stmt = $pdo->query($sql);

    
    if ($stmt->rowCount() > 0) {
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .card {
            height: 400px; 
        }

        .card-body {
            padding: 20px; 
        }

        .card-margin {
            margin-bottom: 20px; 
        }
        .coeur-rouge {
             color: red;
        }

    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #747e88;">
        <div class="container">
            <a class="navbar-brand" href="acceuil.php"><img src="./Images/logo jeuxvideo.png" alt="GameSoft Logo" width="60"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="connexion.php">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="description.html">Qui nous sommes</a>
                     </li>
                     <li class="nav-item">
                     <form id="searchForm" class="d-flex mb-3" method="GET" action="barre_recherche.php">
                     <input id="searchInput" class="form-control me-2" type="search" placeholder="Recherche" aria-label="Recherche" name="query">
                     <select id="searchCriteria" class="form-control" name="critere">
                    <option value="statut">Statut</option>
                    <option value="date_fin">Date de fin</option>
                    <option value="nom">Nom (3 lettres)</option>
                    <option value="type">Type</option>
                    </select>
                    <button id="searchButton" class="btn btn-primary ml-2" type="submit">Recherche</button>
                    </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1>Bienvenue chez GameSoft</h1>
        <p>Studio de jeu vidéo français spécialisé dans les RPG</p>
        <h2>Dernières actualités</h2>

        <div class="container">
            <div class="row" id="searchResults"> 
                <?php
                
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $id = $row['id_jeu'];
                    $titre = $row['titre'];
                    $dateFin = $row['date_fin'];
                    $cheminImage = $row['galerie_images'];
                    $description = $row['description'];
                    $support = $row['support'];
                    $type = $row['type'];
                ?>
                <div class="col-md-6 card-margin">
                    <div class="card">
                        <img src="<?php echo $cheminImage; ?>" class="card-img-top" alt="<?php echo $titre; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $titre; ?></h5>
                            <p class="card-text">Date de fin de création : <?php echo $dateFin; ?></p>
                            <p class="card-text">Support : <?php echo $support; ?></p>
                            <p class="card-text">Type : <?php echo $type; ?></p>
                            <a href="details.php?id_jeu=<?php echo $id; ?>" class="btn btn-primary btn-sm">En savoir plus</a>
                            <button class="btn btn-primary btn-favoris" data-jeu-id="<?php echo $id; ?>"><i class="fas fa-heart"></i> Ajouter aux favoris</button>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            
            $("#searchForm").submit(function(event) {
                event.preventDefault(); 

                
                var query = $("#searchInput").val();
                var criteria = $("#searchCriteria").val();

              
                $("#searchResults").load("barre_recherche.php?query=" + query + "&critere=" + criteria);
            });
        });
    </script>
</body>
</html>
<?php
    } else {
        echo "Aucun jeu en cours trouvé.";
    }
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>



