<?php

include_once '../db_config.php';

$id = $_GET['id'];

try {

    $stmt = $conn->prepare("SELECT * FROM users");
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    $profile = ($result[0]['profile']);

    $sql = "DELETE FROM users where id = $id";
    $conn->exec($sql);

    unlink("admin_uploads/$profile");

    header('Location: manage_users.php');
} catch (PDOException $e) {
    echo "Error:" . $e->getMessage();
}

$conn = null;
