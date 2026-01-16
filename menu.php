<?php
include "auth.php";
verificaAutenticazione();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Menu</title>
    <style>
        button {
            display: block;
            margin: 10px 0;
            padding: 10px;
        }
    </style>
</head>
<body>

<h2>Menu principale</h2>

<form action="gestione_clienti.php">
    <button type="submit">Gestione Clienti</button>
</form>

<form action="consultazione_articoli.php">
    <button type="submit">Consultazione Articoli</button>
</form>

</body>
</html>
