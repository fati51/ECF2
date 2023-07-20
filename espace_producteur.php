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
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Connexion producteur</title>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #747e88;">
    <div class="container">
        <a class="navbar-brand" href="index.php"><img src="./Images/logo jeuxvideo.png" alt="GameSoft Logo" width="100"></a>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item left">
                    <a class="nav-link" href="logout_producteur.php">Déconnexion</a>
                </li>
                <li class="nav-item left">
                    <a class="nav-link" href="ajouter_jeu.php">Ajouter un jeu</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <h1>Espace producteur</h1>
    <p>Bienvenue, producteur !</p>

    <?php
    $servername = "localhost";
    $db_username = "root";
    $db_password = "root";
    $dbname = "gamesoft";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $db_username, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_POST['modifier'])) {
            $jeu_id = $_POST['jeu_id'];
            $nouveau_budget = $_POST['nouveau_budget'];
            $nouveau_statut = $_POST['nouveau_statut'];
            $nouvelle_date_fin = $_POST['nouvelle_date_fin'];
            $commentaire = $_POST['commentaire'];

            $sql = "UPDATE jeux SET budget = :nouveau_budget, statut = :nouveau_statut, date_fin = :nouvelle_date_fin, commentaire = :commentaire WHERE id_jeu = :jeu_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nouveau_budget', $nouveau_budget);
            $stmt->bindParam(':nouveau_statut', $nouveau_statut);
            $stmt->bindParam(':nouvelle_date_fin', $nouvelle_date_fin);
            $stmt->bindParam(':commentaire', $commentaire);
            $stmt->bindParam(':jeu_id', $jeu_id);

            if ($stmt->execute()) {
                echo "Jeu modifié avec succès.";
            } else {
                throw new Exception("Erreur lors de la modification du jeu : " . $stmt->errorInfo());
            }
        }

        $sql = "SELECT * FROM jeux";
        $result = $conn->query($sql);

        if ($result->rowCount() > 0) {
            echo '<table class="table table-dark table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Dernier budget</th>
                            <th>Budget</th>
                            <th>Statut</th>
                            <th>Date de fin</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Commentaire</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>';

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>
                        <td>' . $row["titre"] . '</td>
                        <td>' . $row["dernier_budget"] . '</td>
                        <td>' . $row["budget"] . '</td>
                        <td>' . $row["statut"] . '</td>
                        <td>' . $row["date_fin"] . '</td>
                        <td>' . $row["nom"] . '</td>
                        <td>' . $row["prenom"] . '</td>
                        <td>' . $row["commentaire"] . '</td>
                        <td>
                            <form method="post" action="espace_producteur.php">
                                <input type="hidden" name="jeu_id" value="' . $row["id_jeu"] . '">
                                <input type="text" name="nouveau_budget" placeholder="Nouveau budget">
                                <input type="text" name="nouveau_statut" placeholder="Nouveau statut">
                                <input type="date" name="nouvelle_date_fin">
                                <input type="text" name="commentaire" placeholder="Commentaire">
                                <button type="submit" name="modifier" class="btn btn-warning">Modifier</button>
                            </form>
                        </td>
                    </tr>';
            }

            echo '</tbody>
                </table>';

            echo '<form method="post">
                    <button type="submit" name="calculer_cout_total" class="btn btn-success">Calculer le coût budgétaire total</button>
                </form>';

            if (isset($_POST['calculer_cout_total'])) {
                $sql = "SELECT SUM(budget) AS cout_total FROM jeux";
                $result = $conn->query($sql);

                if ($result->rowCount() > 0) {
                    $row = $result->fetch(PDO::FETCH_ASSOC);
                    $cout_total = $row["cout_total"];
                    echo '<p>Coût budgétaire total : ' . $cout_total . '</p>';
                } else {
                    echo "Aucun jeu trouvé.";
                }
            }
        } else {
            echo "Aucun jeu trouvé.";
        }
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
        exit;
    }
    ?>
</div>

</body>
</html>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

