<?php
require_once "bdd.php";

if (isset($_GET['id'])) {
    $sql = "DELETE FROM posts WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$_GET['id']]);
}

echo "<script>window.location.href='index.php';</script>";
exit;