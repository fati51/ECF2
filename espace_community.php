<!DOCTYPE html>
<html lang="fr">
<html>
<head>
<link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Community Manager - Fil d'actualités</title>
    <style>
       
        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
        }

        .form-group textarea {
          width: 100%;
        height: 400px;
        resize: vertical;
                              }

        .form-group input[type="submit"] {
            padding: 10px 20px;
        }

        .success-message {
            color: green;
        }

        .error-message {
            color: red;
        }

        .news-item {
            margin-bottom: 20px;
        }

        .news-item p {
            margin: 0;
        }

        .news-item .author {
            font-weight: bold;
        }

        .news-item .date {
            color: gray;
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
                            <a class="nav-link" href="recupe_jeu.php">Tous les jeux</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout_community.php">Deconnexion</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    <div class="container">
        <h2>Community Manager - Fil d'actualités</h2>

        <div class="form-group">
            <form method="post" action="publish.php">
                <label for="contenu">Nouvelle actualité :</label>
                <textarea name="contenu" id="contenu" placeholder="Entrez votre actualité ici..." required></textarea>
                <input type="submit" value="Publier">
            </form>
        </div>

        <?php
        if(isset($_GET['success'])) {
            echo '<p class="success-message">Publication effectuée avec succès.</p>';
        } elseif(isset($_GET['error'])) {
            echo '<p class="error-message">Erreur lors de la publication : ' . $_GET['error'] . '</p>';
        }
        ?>

        <h3>Fil d'actualités</h3>

        <?php
        
        $sql = "SELECT * FROM publications ORDER BY date_publication DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="news-item">';
                echo '<p class="author">'.$row["auteur"].'</p>';
                echo '<p>'.$row["contenu"].'</p>';
                echo '<p class="date">'.$row["date_publication"].'</p>';
                echo '</div>';
            }
        } else {
            echo "Aucune publication trouvée.";
        }
        ?>
    </div>
</body>
</html>
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

