<?php

include_once '../db_config.php';

$id = $_POST['id'];

try {

    $stmt = $conn->prepare("SELECT * FROM books WHERE id = $id");
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    $images = ($result[0]['images']);

    if (!empty($_FILES['images']['tmp_name'])) {
        if (isset($_FILES['images'])) {

            unlink("books_uploads/$images");
            $img = $_FILES['images'];

            $imgName = $_FILES['images']['name'];
            $imgTmpName = $_FILES['images']['tmp_name'];
            $imgSize = $_FILES['images']['size'];
            $imgError = $_FILES['images']['error'];
            $imgType = $_FILES['images']['type'];

            $imgExt = explode('.', $imgName);
            $imgActualExt = strtolower(end($imgExt));

            $allow = array('png', 'jpg', 'jpeg');
            if (in_array($imgActualExt, $allow)) {

                if ($imgError === 0) {

                    if ($imgSize < 10000000) {

                        $imgNameNew = $id . "." . $imgActualExt;
                        $imgDestination = 'books_uploads/' . $imgNameNew;
                        move_uploaded_file($imgTmpName, $imgDestination);

                        $stmt = $conn->prepare("UPDATE books SET images = '$imgNameNew' WHERE id = $id");
                        $stmt->execute();
                    } else {
                        $e = '<div class="alert alert-danger h6" role="alert">Your Image is too Big</div>';
                    }
                } else {
                    $e = '<div class="alert alert-danger h6" role="alert">There Was an Error Uploading Your Image</div>';
                }
            } else {
                $e = '<div class="alert alert-danger h6" role="alert">You Cannot Upload Image of This Type</div>';
            }
        }
    }

    $stmt = $conn->prepare(
        "UPDATE books SET 
        title = '" . $_POST['title'] . "', 
        description = '" . $_POST['description'] . "', 
        quantity = '" . $_POST['quantity'] . "', 
        category_id = '" . $_POST['category_name'] . "', 
        author_id = '" . $_POST['author_name'] . "', 
        books_status = '" . $_POST['books_status'] . "' where id = " . $_POST['id']
    );
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error:" . $e->getMessage();
}

$conn = null;
header('Location: manage_books.php');
