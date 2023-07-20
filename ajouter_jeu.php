<?php
require_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $statut = isset($_POST['statut']) ? $_POST['statut'] : '';
    $dateDebut = isset($_POST['date_debut']) ? $_POST['date_debut'] : '';
    $dateFin = isset($_POST['date_fin']) ? $_POST['date_fin'] : '';
    $budget = isset($_POST['budget']) ? $_POST['budget'] : '';
    $commentaire = isset($_POST['commentaire']) ? $_POST['commentaire'] : '';
    $score = 0;
    $titre = isset($_POST['titre']) ? $_POST['titre'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $nom_studio = isset($_POST['nom_studio']) ? $_POST['nom_studio'] : '';
    $support = isset($_POST['support']) ? $_POST['support'] : '';
    $poids = isset($_POST['poids']) ? $_POST['poids'] : '';
    $galerie_images = isset($_POST['galerie_images']) ? $_POST['galerie_images'] : '';
    $moteur = isset($_POST['moteur']) ? $_POST['moteur'] : '';
    $date_estimee = isset($_POST['date_estimee']) ? $_POST['date_estimee'] : '';
    $type = isset($_POST['type']) ? $_POST['type'] : '';
    $nombre_joueur = isset($_POST['nombre_joueur']) ? $_POST['nombre_joueur'] : '';
    $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
    $dateDerniereMiseAJour = isset($_POST['date_derniere_mise_a_jour']) ? $_POST['date_derniere_mise_a_jour'] : '';

    if ($statut !== '' && $dateDebut !== '' && $dateFin !== '' && $budget !== '') {
        try {
            $sqlInsert = "INSERT INTO jeux (statut, date_debut, date_fin, budget, commentaire, score, titre, description, nom_studio, support, poids, galerie_images, moteur, date_estimee, type, nombre_joueur, nom, prenom, date_derniere_mise_a_jour) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmtInsert = $pdo->prepare($sqlInsert);
            $stmtInsert->execute([$statut, $dateDebut, $dateFin, $budget, $commentaire, $score, $titre, $description, $nom_studio, $support, $poids, $galerie_images, $moteur, $date_estimee, $type, $nombre_joueur, $nom, $prenom, $dateDerniereMiseAJour]);

          
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout du jeu : " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Ajouter un jeu</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
        }

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
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #747e88;">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img src="./Images/logo jeuxvideo.png" alt="GameSoft Logo" width="60"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav ml-auto">

            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <h2 class="text-center mb-4">Ajouter un jeu</h2>

    <form action="ajouter_jeu.php" method="POST" class="form-group">

        <label>Titre :</label>
        <input type="text" name="titre" required class="form-control">
        <br>
        <label>Statut :</label>
        <input type="text" name="statut" required class="form-control">
        <br>
        <label>Date de début :</label>
        <input type="date" name="date_debut" required class="form-control">
        <br>
        <label>Date de fin :</label>
        <input type="date" name="date_fin" required class="form-control">
        <br>
        <label>Budget :</label>
        <input type="number" name="budget" required class="form-control">
        <br>
        <label>Commentaire :</label>
        <textarea name="commentaire" class="form-control"></textarea>
        <br>
        <label>Score :</label>
        <input type="number" name="score" value="0" class="form-control">
        <br>
        <label>Description :</label>
        <textarea name="description" class="form-control"></textarea>
        <br>
        <label>Nom du studio :</label>
        <input type="text" name="nom_studio" required class="form-control">
        <br>
        <label>Support :</label>
        <input type="text" name="support" required class="form-control">
        <br>
        <label>Poids :</label>
        <input type="text" name="poids" class="form-control">
        <br>
        <label>Galerie d'images :</label>
        <input type="file" name="galerie_images" class="form-control">
        <br>
        <label>Moteur :</label>
        <input type="text" name="moteur" class="form-control">
        <br>
        <label>Date estimée :</label>
        <input type="date" name="date_estimee" class="form-control">
        <br>
        <label>Date dernière mise a jour :</label>
        <input type="date" name="date_derniere_mise_a_jour" class="form-control">
        <br>
        <label>Type :</label>
        <input type="text" name="type" class="form-control">
        <br>
        <label>Nombre de joueurs :</label>
        <input type="number" name="nombre_joueur" class="form-control">
        <br>
        <label>Nom :</label>
        <input type="text" name="nom" class="form-control">
        <br>
        <label>Prénom :</label>
        <input type="text" name="prenom" class="form-control">
        <br>
        <input type="submit" value="Ajouter" class="btn btn-primary">
    </form>
</div>

</body>
</html>
<?php
session_start();

if (isset($_SESSION['producteur'])) {
    header('Location: login_producteur.php');
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_username = $_POST["username"];
    $form_password = $_POST["password"];

    $servername = "localhost";
    $db_username = "gamesoft";
    $db_password = "root";
    $dbname = "root";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $db_username, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare('SELECT id, pseudo, mail, mot_de_passe, role FROM utilisateurs WHERE pseudo = :username');
        $stmt->bindParam(':username', $form_username);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user && password_verify($form_password, $user['mot_de_passe']) && $user['role'] === 'producteur') {
            $_SESSION['producteur'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['pseudo'];
            $_SESSION['email'] = $user['mail'];
            header('Location: espace_producteur.php');
            exit;
        } else {
            $error = "Identifiant ou mot de passe incorrect.";
        }
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion producteur</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
   
<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #747e88;">
    <div class="container">
        <a class="navbar-brand" href="index.php"><img src="./Images/logo jeuxvideo.png" alt="GameSoft Logo" width="100"></a>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <h1 class="text-center mb-4">Connexion producteur</h1>

    <?php if (!empty($error)) { ?>
        <p class="text-center text-danger"><?php echo $error; ?></p>
    <?php } ?>

    <form class="text-center mb-4" style="max-width: 400px; margin: 0 auto;" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group ">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" class="form-control" name="username" required>
        </div>

        <div class="form-group">
            <label for="password">Mot de passe :</label>
            <input type="password" class="form-control" name="password" required pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}$" title="Le mot de passe doit contenir au moins 8 caractères, une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial">
        </div>

        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
