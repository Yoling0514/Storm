<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "123Soleil";
$dbname = "users_db";

$conn = new mysqli(hostname: $servername, username: $username, password: $password, database: $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connexion à la base de données réussie.<br>";
}

// Vérification des données du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // Préparation et exécution de la requête SQL
    $stmt = $conn->prepare(query: "SELECT password FROM users WHERE email = ?");
    $stmt->bind_param(types: "s", var: $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result(var: $hashed_password);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && password_verify(password: $pass, hash: $hashed_password)) {
        header(header: "Location: home.html");
        exit();
    } else {
        echo "Email ou mot de passe incorrect.";
    }

    $stmt->close();
}

$conn->close();
?>
