
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Espace producteur</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .navbar-nav li {
            text-align: left;
        }

        .navbar-nav li:not(:last-child) {
            margin-right: 30px;
        }

        h1, p {
            color: white;
        }

        table {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #747e88;">
    <div class="container">
        <a class="navbar-brand" href="login_producteur.php"><img src="./Images/logo jeuxvideo.png" alt="GameSoft Logo" width="100"></a>
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
    $username = "root";
    $password = "root";
    $dbname = "Gamesoft";
    try {
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            throw new Exception("Erreur de connexion à la base de données : " . $conn->connect_error);
        }

        if (isset($_POST['modifier'])) {
            $jeu_id = $_POST['jeu_id'];
            $nouveau_budget = $_POST['nouveau_budget'];
            $nouveau_statut = $_POST['nouveau_statut'];
            $nouvelle_date_fin = $_POST['nouvelle_date_fin'];
            $commentaire = $_POST['commentaire'];

            $sql = "UPDATE jeux SET budget = '$nouveau_budget', statut = '$nouveau_statut', date_fin = '$nouvelle_date_fin', commentaire = '$commentaire' WHERE id_jeu = $jeu_id";
            if ($conn->query($sql) === TRUE) {
                echo "Jeu modifié avec succès.";
            } else {
                throw new Exception("Erreur lors de la modification du jeu : " . $conn->error);
            }
        }

        $sql = "SELECT * FROM jeux";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table class="table table-dark table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Dernier budget</th>
                            <th>Budget</th>
                            <th>Statut</th>
                            <th>Date de fin</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Commentaire</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>';

            while ($row = $result->fetch_assoc()) {
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

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $cout_total = $row["cout_total"];
                    echo '<p>Coût budgétaire total : ' . $cout_total . '</p>';

                } else {
                    echo "Aucun jeu trouvé.";
                }
            }
        } else {
            echo "Aucun jeu trouvé.";
        }

        $conn->close();
    } catch (Exception $e) {
        echo "Erreur MySQL : " . $e->getMessage();
    }
    ?>
</div>

</body>
</html>