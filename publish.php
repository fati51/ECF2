<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "gamesoft";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}


if(isset($_POST['contenu'])) {
    $contenu = $_POST['contenu'];

   
    $stmt = $conn->prepare("INSERT INTO publications (auteur, contenu, date_publication) VALUES (?, ?, NOW())");
    $stmt->bind_param("ss", $auteur, $contenu);

    if ($stmt->execute()) {
        header("Location: espace_community.php?success=true");
        exit();
    } else {
        header("Location: index.php?error=" . $stmt->error);
        exit();
    }
    
  
    $stmt->close();
}

$conn->close();
?>
