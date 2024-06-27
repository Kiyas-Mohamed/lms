<?php

include_once '../db_config.php';

$id = $_POST['id'];

try {

    $stmt = $conn->prepare("SELECT * FROM users WHERE id = $id");
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    $profiles = ($result[0]['profile']);

    if (!empty($_FILES['profile']['tmp_name'])) {
        if (isset($_FILES['profile'])) {

            unlink("admin_uploads/$profiles");
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
                        $imgNameNew = $id . "." . $imgActualExt;
                        $imgDestination = 'admin_uploads/' . $imgNameNew;
                        move_uploaded_file($imgTmpName, $imgDestination);

                        $stmt = $conn->prepare("UPDATE users SET profile = '$imgNameNew' WHERE id = $id");
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
        "UPDATE users SET 
        full_name = '" . $_POST['full_name'] . "', 
        email = '" . $_POST['email'] . "', 
        password = '" . $_POST['password'] . "', 
        phone = '" . $_POST['phone'] . "', 
        role = '" . $_POST['role'] . "', 
        status = '" . $_POST['status'] . "' where id = " . $_POST['id']
    );
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error:" . $e->getMessage();
}

$conn = null;
header('Location: manage_users.php');
