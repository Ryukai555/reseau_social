<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require_once "bdd.php";

$sql = "SELECT posts.*, users.pseudo 
        FROM posts 
        JOIN users ON posts.user_id = users.id";
$stmt = $db->query($sql);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réseau social</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <h1>Posts</h1>

    <a href="logout.php">Déconnexion</a>

    <form method="POST" action="add_post.php">
        <input type="text" name="title" placeholder="Titre" required>
        <textarea name="content" placeholder="Contenu" required></textarea>
        <button type="submit">Ajouter</button>
    </form>

    <?php foreach ($posts as $post): ?>
        <div class="post">

            <div class="actions">
                <a class="edit" href="edit_post.php?id=<?= $post['id'] ?>">Modifier</a>
                <a class="delete" href="delete_post.php?id=<?= $post['id'] ?>">Supprimer</a>
            </div>

            <p><strong><?= htmlspecialchars($post['pseudo']) ?></strong></p>

            <h3><?= htmlspecialchars($post['title']) ?></h3>
            <p><?= htmlspecialchars($post['content']) ?></p>

            <hr>
        </div>
    <?php endforeach; ?>

</body>

</html>