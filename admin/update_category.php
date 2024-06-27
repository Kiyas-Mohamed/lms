<?php

include_once '../db_config.php';

$category_id = $_GET['category_id'];

try {

    $stmt = $conn->prepare(
        "UPDATE categories SET 
        category_name = '" . $_POST['category_name'] . "', 
        status = '" . $_POST['status'] . "' where category_id = " . $_POST['category_id']
    );
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error:" . $e->getMessage();
}

$conn = null;

header('Location: manage_category.php');
