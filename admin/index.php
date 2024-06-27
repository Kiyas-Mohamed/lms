<?php
session_start();
include_once '../db_config.php';
if (isset($_SESSION['AdminId'])) {

    header("Location: dashboard.php");
}

try {

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

                    $_SESSION["AdminId"] = $row["id"];
                    header("Location: dashboard.php");
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

?>

<!-- Header Start -->
<?php include_once '../admin/template/header.php'; ?>
<!-- End Header -->

<link rel="stylesheet" href="admin/assets/css/all.min.css">

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">

                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4"><i class="fa-solid fa-right-to-bracket"></i> Login</h3>
                                </div>

                                <div>
                                    <?php
                                    if (isset($e)) {

                                        echo $e;
                                    }
                                    ?>
                                </div>

                                <div class="card-body">
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label" for="form6Example1">Email</label>
                                            <input type="email" name="email" id="form6Example1" class="form-control" />
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label class="form-label" for="form6Example1">Password</label>
                                            <input type="password" name="password" id="form6Example1" class="form-control" />
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a href="../admin/password.php">Forgot Password?</a>
                                            <button class="btn btn-primary" type="submit" name="login"><i class="fa-solid fa-right-to-bracket"></i> Login</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <!-- Footer Start -->
        <?php include_once '../admin/template/footer.php'; ?>
        <!-- End Footer -->
</body>

</html>