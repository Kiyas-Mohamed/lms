<?php

include_once '../db_config.php';

$category_id = $_GET['category_id'];

try {

    $sql = "DELETE FROM categories where category_id = $category_id";
    $conn->exec($sql);

    header('Location: manage_category.php');
} catch (PDOException $e) {
    echo "Error:" . $e->getMessage();
}

$conn = null;
