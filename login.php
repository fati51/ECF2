<?php
session_start();

// Vérifier si l'utilisateur est déjà connecté, le rediriger vers l'espace administrateur
if (isset($_SESSION['admin'])) {
    header('Location: espace_admin.php');
    exit;
}

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier les informations d'identification de l'administrateur
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Vérifier les informations d'identification de l'administrateur (vous pouvez utiliser votre propre logique de vérification)
    if ($username === "admin" && $password === "admin123") {
        // Authentification réussie, définir la session et rediriger vers l'espace administrateur
        $_SESSION['admin'] = true;
        header('Location: espace_admin.php');
        exit;
    } else {
        // Authentification échouée, afficher un message d'erreur
        $error = "Identifiant ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Connexion administrateur</title>
</head>
<body>
<style>
       body {
    margin: 0;
    padding: 0;
}



a {
    text-decoration: none;
    color: #fff; 
}

.group{
    color: white;
    
}




.navbar-nav li:not(:last-child) {
    margin-right: 30px;
}
h1{
    color : white;
}

    </style>

    <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #747e88;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="./Images/logo jeuxvideo.png" alt="GameSoft Logo" width="60"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                
            </ul>
        </div>
    </div>
</nav>
    <h1>Connexion administrateur</h1>
    <?php if (isset($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>
    <div class ="group">
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" name="username" required><br>

        <label for="password">Mot de passe :</label>
        <input type="password" name="password" required><br>
    </div>
    <button type="submit" class="btn btn-success">Connexion</button>
    </form>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</html>
