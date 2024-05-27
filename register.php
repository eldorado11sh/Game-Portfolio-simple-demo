<?php
// Configuración de la base de datos
$host = 'localhost';
$dbname = 'l2jmobiusinterlude';
$user = 'moon'; // Cambia esto a tu usuario de la base de datos
$pass = 'NZo8C6e@!qdHr-N'; // Cambia esto a tu contraseña de la base de datos

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

function vCode($content) {
    return addslashes(htmlentities(trim(utf8_decode($content)), ENT_QUOTES, 'ISO-8859-1'));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = vCode($_POST['username']);
    $email = vCode($_POST['email']);
    $password = vCode($_POST['password']);
    $confirm_password = vCode($_POST['confirm_password']);
    $accept_rules = isset($_POST['accept_rules']) ? true : false;

    // Validaciones básicas
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        die("All fields are required.");
    }
    
    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    if (!$accept_rules) {
        die("You must accept the rules.");
    }

    // Hash de la contraseña
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    // Insertar usuario en la base de datos
    try {
        $stmt = $pdo->prepare("INSERT INTO accounts (login, password, email) VALUES (:login, :password, :email)");
        $stmt->bindParam(':login', $username);
        $stmt->bindParam(':password', $passwordHash);
        $stmt->bindParam(':email', $email);
        
        if ($stmt->execute()) {
            echo "Registration successful!";
        } else {
            echo "Registration failed. Please try again.";
        }
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
}
?>
