<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "123Soleil";
$dbname = "users_db";

$conn = new mysqli(hostname: $servername, username: $username, password: $password, database: $dbname);

if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
} else {
    echo "Connexion à la base de données réussie.<br>";
}

// Vérification des données du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash(password: $_POST["password"], algo: PASSWORD_BCRYPT);

    // Préparation et exécution de la requête SQL
    $stmt = $conn->prepare(query: "INSERT INTO users (username, email, passwords) VALUES (?, ?, ?)");
    $stmt->bind_param(types: "sss", var: $username, vars: $email, $password);
    
    if ($stmt->execute()) {
        echo "Inscription réussie !";
    } else {
        echo "Erreur : " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
