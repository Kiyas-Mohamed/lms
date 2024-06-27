<?php

include_once '../db_config.php';

$id = $_GET['id'];

try {

    $stmt = $conn->prepare("SELECT * FROM books");
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    $images = ($result[0]['images']);

    $sql = "DELETE FROM books where id = $id";
    $conn->exec($sql);

    unlink("books_uploads/$images");

    header('Location: manage_books.php');
} catch (PDOException $e) {
    echo "Error:" . $e->getMessage();
}

$conn = null;
