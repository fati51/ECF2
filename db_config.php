
<?php
$servername = 'localhost';
$username = 'u379183731_root';
$password = 'Khadidja69@';
$dbname = 'u379183731_jeux';
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit();
}
?>
