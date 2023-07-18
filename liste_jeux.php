<?php
$host = 'localhost';
$dbname = 'gamesoft';
$username = 'root';
$password = 'root';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    exit();
}

$sql = "SELECT * FROM jeux";
$stmt = $conn->query($sql);
$jeux = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Liste des jeux</title>
    <style>
        a {
            text-decoration: none;
            color: #fff;
        }
        .navbar-nav li:not(:last-child) {
            margin-right: 30px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #747e88;">
    <div class="container">
        <a class="navbar-brand" href="espace_admin.php"><img src="./Images/logo jeuxvideo.png" alt="GameSoft Logo" width="60"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="logout.php">Déconnexion</a>
                </li>
                <li class="nav-item">
                    <a href="ajouter_jeu.php">Ajouter un jeu</a>
                </li>
               
                <li class="nav-item">
                    <a href="creation_compte.php">Création compte</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <h1>Liste des jeux</h1>
    <table class="table table-dark table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Titre</th>
                <th>Statut</th>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>Budget</th>
                <th>Score</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jeux as $jeu) { ?>
                <tr>
                    <td><?php echo $jeu['titre']; ?></td>
                    <td><?php echo $jeu['statut']; ?></td>
                    <td><?php echo $jeu['date_debut']; ?></td>
                    <td><?php echo $jeu['date_fin']; ?></td>
                    <td><?php echo $jeu['budget']; ?></td>
                   
                    <td>
            <?php
                $stmt = $conn->prepare('SELECT score FROM favoris WHERE user_id = ? AND jeu_id = ?');
                $stmt->execute([$_SESSION['user_id'], $jeu['id']]);
                $favori = $stmt->fetch();
                $score = $favori ? $favori['score'] : 0;
                echo $score;
            ?>
        </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


</body>
</html>
