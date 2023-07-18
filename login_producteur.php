<?php
session_start();


if (isset($_SESSION['producteur'])) {
    header('Location: producteur.php');
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST["username"];
    $password = $_POST["password"];

    
    $servername = "localhost";
    $db_username = "root";
    $db_password = "root";
    $dbname = "gamesoft";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $db_username, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
        $stmt = $conn->prepare('SELECT id, pseudo, mail, mot_de_passe, role FROM utilisateurs WHERE pseudo = :username');
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch();

        
        if ($user && password_verify($password, $user['mot_de_passe']) && $user['role'] === 'producteur') {
            
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Connexion producteur</title>
</head>
<body>
   
<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #747e88;">
    <div class="container">
        <a class="navbar-brand" href="acceuil.php"><img src="./Images/logo jeuxvideo.png" alt="GameSoft Logo" width="100"></a>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <h1 class="text-center mb-4">Connexion producteur</h1>

    <?php if (isset($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>

    <form class="text-center mb-4"style="max-width: 400px; margin: 0 auto;" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
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
