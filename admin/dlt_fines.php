<?php

include_once '../db_config.php';
$id = $_GET['id'];

try {

    $sql = "DELETE FROM fines WHERE id = $id";
    $conn->exec($sql);

    header('Location: manage_fines.php');
} catch (PDOException $e) {
    echo "Error:" . $e->getMessage();
}

$conn = null;
