<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace utilisateur</title>
</head>
<body>

<style>
       body {
    margin: 0;
    padding: 0;
}

h2{ color : white;}
p{ color : white ;}

a {
    text-decoration: none;
    color: #fff; 
}

div {
    color: white;
}

.navbar-nav li:not(:last-child) {
    margin-right: 30px;
}

    </style>
    <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #747e88;">
    <div class="container-fluid">
        <a class="navbar-brand" href="espace_admin.php"><img src="./Images/logo jeuxvideo.png" alt="GameSoft Logo" width="60"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="logout_users.php">Déconnexion</a>
                </li>
                <li class="nav-item">
                    <a href="#ajouter_favoris.php">Mes Favorit</a>
                </li>
               
                <li class="nav-item">
                    <a href="recupe_jeu.php">Tout les jeux </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
    <?php
    echo "<h2>Bienvenue dans votre espace utilisateur, $username!</h2>";
echo "<p>Votre email : $email</p>";
?>
    
</body>
</html>

