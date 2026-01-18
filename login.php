<?php

$conn = new mysqli("localhost", "root", "Ykkmacbook79", "test");



$dsn = 'mysql:dbname=test;host=localhost'; // DSN per MySQL
$utente = 'root';
$password = 'Ykkmacbook79';

try {
   $pdo = new PDO($dsn, $utente, $password);
// Opzionale: imposta modalità di gestione errori (lancia eccezioni)
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT id, password FROM utenti WHERE username = :username");
    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row && password_verify($password, $row['password'])) {
        // Autenticazione riuscita: creo cookie valido 30 minuti
        setcookie("auth_token", $row['id'], time() + (30 * 60), "/");
        header("Location: menu.php");
        exit;
    }

    $errore = "Credenziali non valide";
}


    echo "Connessione riuscita!";
    // Qui puoi eseguire query SQL
    
} catch (PDOException $e) {
    echo "Errore di connessione: " . $e->getMessage();
}




?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

<?php if (isset($errore)) echo "<p>$errore</p>"; ?>

<form method="POST">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Accedi</button>
</form>

</body>
</html>

