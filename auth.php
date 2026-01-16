<?php
function verificaAutenticazione() {
    if (!isset($_COOKIE['auth_token'])) {
        header("Location: login.php");
        exit;
    }
}
?>
