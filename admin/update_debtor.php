<?php

include_once '../db_config.php';
$id = $_GET['lend_id'];

try {

    $stmt = $conn->prepare(
        "UPDATE   lendings SET 
        lendings_status = '" . $_POST['lendings_status'] . "', 
        given_date = '" . $_POST['given_date'] . "', 
        received_date = '" . $_POST['received_date'] . "' WHERE lend_id = " . $_POST['lend_id']
    );
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error:" . $e->getMessage();
}

$conn = null;

header('Location: manage_lendings.php');
