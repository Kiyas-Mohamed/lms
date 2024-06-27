<?php

include_once '../db_config.php';

$author_id = $_GET['author_id'];

try {

    $stmt = $conn->prepare("SELECT * FROM authors");
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    $profile = ($result[0]['profile']);

    $sql = "DELETE FROM authors where author_id = $author_id";
    $conn->exec($sql);

    unlink("authors_uploads/$profile");

    header('Location: manage_author.php');
} catch (PDOException $e) {
    echo "Error:" . $e->getMessage();
}

$conn = null;
