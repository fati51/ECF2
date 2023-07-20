<?php
session_start();

$host = 'localhost';
$dbname = 'u379183731_jeux';
$username = 'u379183731_root';
$password = 'Khadidja69@';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    exit();
}

if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    
    $stmt = $conn->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
    $stmt->execute([$username, $email, $password]);

    if ($stmt->rowCount() > 0) {
        header("Location: connexion.php");
        exit();
    } else {
        echo "Erreur lors de l'inscription : " . $stmt->errorInfo()[2];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<style>
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
        <a class="navbar-brand" href="index.php"><img src="./Images/logo jeuxvideo.png" alt="GameSoft Logo" width="60"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="connexion.php">Connexion</a>
                </li>
               
                <li class="nav-item">
                    <a href="recupe_jeu.php">Tous les jeux</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
    
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2>Inscription</h2>
                <div class="form-group">
                    <label for="username"><b>Nom d'utilisateur</b></label>
                    <input type="text" class="form-control" name="username" required>
                </div>
                <div class="form-group">
                    <label for="email"><b>Email</b></label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password"><b>Mot de passe</b></label>
                    <input type="password" class="form-control" name="password" required pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}$" title="Le mot de passe doit contenir au moins 8 caractères, une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial">
                </div>
                <button type="submit" class="btn btn-success">S'inscrire</button>
            </div>
        </div>
    </div>
</form>
   
</body>
</html>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

