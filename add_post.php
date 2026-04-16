<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require_once "bdd.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);

    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO posts (title, content, user_id) VALUES (?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([$title, $content, $user_id]);
}

header("Location: index.php");
exit;