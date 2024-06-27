<?php

include_once '../db_config.php';

$author_id = $_POST['author_id'];

try {

    $stmt = $conn->prepare("SELECT * FROM authors WHERE author_id = $author_id");
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    $profiles = ($result[0]['profile']);

    if (!empty($_FILES['profile']['tmp_name'])) {
        if (isset($_FILES['profile'])) {

            unlink("authors_uploads/$profiles");
            $img = $_FILES['profile'];

            $imgName = $_FILES['profile']['name'];
            $imgTmpName = $_FILES['profile']['tmp_name'];
            $imgSize = $_FILES['profile']['size'];
            $imgError = $_FILES['profile']['error'];
            $imgType = $_FILES['profile']['type'];

            $imgExt = explode('.', $imgName);
            $imgActualExt = strtolower(end($imgExt));

            $allow = array('png', 'jpg', 'jpeg',);
            if (in_array($imgActualExt, $allow)) {

                if ($imgError === 0) {

                    if ($imgSize < 10000000) {
                        $imgNameNew = $author_id . "." . $imgActualExt;
                        $imgDestination = 'authors_uploads/' . $imgNameNew;
                        move_uploaded_file($imgTmpName, $imgDestination);

                        $stmt = $conn->prepare("UPDATE authors SET profile = '$imgNameNew' WHERE author_id = $author_id");
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
        "UPDATE authors SET 
        author_name = '" . $_POST['author_name'] . "',
        status = '" . $_POST['status'] . "' where author_id = " . $_POST['author_id']
    );
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error:" . $e->getMessage();
}

$conn = null;
header('Location: manage_author.php');
