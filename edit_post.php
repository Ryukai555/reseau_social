<?php
require_once "bdd.php";

if (!isset($_GET['id'])) {
    die("ID manquant");
}

$id = $_GET['id'];

// récupérer le post
$sql = "SELECT * FROM posts WHERE id = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    die("Post introuvable");
}

// si formulaire envoyé
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "UPDATE posts SET title = ?, content = ? WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$title, $content, $id]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<h1>Modifier</h1>

<form method="POST">
    <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>">
    <textarea name="content"><?= htmlspecialchars($post['content']) ?></textarea>
    <button type="submit">Modifier</button>
</form>

</body>
</html>