<?php

include_once '../db_config.php';
$id = $_GET['id'];

try {

    $stmt = $conn->prepare(
        "UPDATE fines SET 
        book_id = '" . $_POST['book_id'] . "', 
        user_id = '" . $_POST['user_id'] . "', 
        amount = '" . $_POST['amount'] . "', 
        fine_date = '" . $_POST['fine_date'] . "' WHERE id = " . $_POST['id']
    );
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error:" . $e->getMessage();
}

$conn = null;

header('Location: manage_fines.php');
