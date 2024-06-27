<?php

include_once '../db_config.php';

$id = $_GET['id'];

try {

    $sql = "DELETE FROM lendings where lend_id = $id";
    $conn->exec($sql);

    header('Location: manage_lendings.php');
} catch (PDOException $e) {
    echo "Error:" . $e->getMessage();
}

$conn = null;
