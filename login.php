<?php
session_start();
$conn = new mysqli("localhost", "root", "", "tuo_database");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM utenti WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            // Autenticazione riuscita: creo cookie valido 30 minuti
            setcookie("auth_token", $row['id'], time() + (30 * 60), "/");
            header("Location: menu.php");
            exit;
        }
    }

    $errore = "Credenziali non valide";
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
