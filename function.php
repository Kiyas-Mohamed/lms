<?php
session_start();
include_once 'db_config.php';

try {

    // Register Form Dev
    if (isset($_POST['register'])) {

        if (empty($_POST['full_name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['phone'])) {

            $e = '<div class="alert alert-danger h6" role="alert"><i class="fa-solid fa-xmark"></i> All Fields Required</div>';
        } else {

            $stmt = $conn->prepare("SELECT email FROM users WHERE email = :email");
            $stmt->execute(array('email' => $_POST['email']));

            $check = $stmt->rowCount();
            if ($check > 0) {

                $e = '<div class="alert alert-danger h6" role="alert"><i class="fa-solid fa-xmark"></i> This Email <b>' . $_POST['email'] . '</b> Already Exists</div>';
            } else {

                $stmt = $conn->prepare("INSERT INTO users (full_name, email, password, phone) 
                VALUES (:full_name, :email, :password, :phone)");

                $stmt->bindParam(':full_name', $full_name);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':phone', $phone);

                $full_name = $_POST['full_name'];
                $email = $_POST['email'];
                $password = md5($_POST['password']);
                $phone = $_POST['phone'];
                $stmt->execute();

                $img = $_FILES['profile'];

                $imgName = $_FILES['profile']['name'];
                $imgTmpName = $_FILES['profile']['tmp_name'];
                $imgSize = $_FILES['profile']['size'];
                $imgError = $_FILES['profile']['error'];
                $imgType = $_FILES['profile']['type'];

                $imgExt = explode('.', $imgName);
                $last_id = $conn->lastInsertId();
                $imgActualExt = strtolower(end($imgExt));

                $allow = array('png', 'jpg', 'jpeg');
                if (in_array($imgActualExt, $allow)) {

                    if ($imgError === 0) {

                        if ($imgSize < 100000) {
                            $imgNameNew = $last_id . "." . $imgActualExt;
                            $imgDestination = 'admin/admin_uploads/' . $imgNameNew;
                            move_uploaded_file($imgTmpName, $imgDestination);

                            $stmt = $conn->prepare("UPDATE users SET profile = '$imgNameNew' WHERE id = '$last_id'");
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

                $stmt = $conn->prepare("SELECT * FROM users");
                $stmt->execute();

                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $result = $stmt->fetchAll();

                foreach ($result as $row) {

                    $_SESSION["UserId"] = $row["id"];
                    $_SESSION["UserProfile"] = $row["profile"];
                    $_SESSION["UserFullName"] = $row["full_name"];
                    $_SESSION["UserEmail"] = $row["email"];
                    $_SESSION["UserPassword"] = $row["password"];
                    $_SESSION["UserPhone"] = $row["phone"];
                }

                if ($result[0]['status'] == '1') {

                    $status = '<option value="1" selected>Active</option>
                            <option value="0">Deactive</option>';
                } else {

                    $status = '<option value="1">Active</option>
                            <option value="0" selected>Deactive</option>';
                }

                if ($result[0]['status'] == '1') {

                    $status = 'Active';
                } else {

                    $status = 'Deactive';
                }

                header('Location: index.php');
            }
        }
    }


    // Login Form Dev
    if (isset($_POST['login'])) {

        if (empty($_POST['email']) || empty($_POST['password'])) {

            $e = '<div class="alert alert-danger h6" role="alert"><i class="fa-solid fa-xmark"></i> All Fields Required</div>';
        } else {

            $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
            $stmt->execute(array('email' => $_POST['email'], 'password' => md5($_POST['password'])));

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();

            foreach ($result as $row) {

                $check = $stmt->rowCount();
                if ($check > 0) {

                    $_SESSION["UserId"] = $row["id"];
                    $_SESSION["UserProfile"] = $row["profile"];
                    $_SESSION["UserFullName"] = $row["full_name"];
                    $_SESSION["UserEmail"] = $row["email"];
                    $_SESSION["UserPassword"] = $row["password"];
                    $_SESSION["UserPhone"] = $row["phone"];
                    header('Location: index.php');
                } else {

                    $e = '<div class="alert alert-danger h6" role="alert"><i class="fa-solid fa-xmark"></i> Please Enter The <b>Correct</b> Value</div>';
                }
            }
        }
    }
} catch (PDOException $e) {
    echo "Error:" . $e->getMessage();
}

$conn = null;
