<?php
require_once "bdd.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // 🔒 Vérification email
    $check = $db->prepare("SELECT * FROM users WHERE email = ?");
    $check->execute([$email]);

    if ($check->fetch()) {
        echo "Email déjà utilisé";
        exit;
    }

    $sql = "INSERT INTO users (pseudo, email, password) VALUES (?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([$pseudo, $email, $password]);

    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>

<h1>Inscription</h1>

<form method="POST">
    <input type="text" name="pseudo" placeholder="Pseudo" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit">S'inscrire</button>
</form>

<p><a href="login.php">Déjà un compte ?</a></p>

</body>
</html>