<!-- Header Start -->
<?php include_once '../admin/template/header.php'; ?>
<!-- End Header -->

<?php

include_once '../db_config.php';

$id = $_GET['id'];

try {

    $stmt = $conn->prepare("SELECT * FROM users where id = $id");
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    if ($result[0]['role'] == '1') {

        $role = '<option value="1" selected>Admin</option>
                <option value="0">Member</option>';
    } else {

        $role = '<option value="1">Admin</option>
                <option value="0" selected>Member</option>';
    }

    if ($result[0]['status'] == '1') {

        $status = '<option value="1" selected>Active</option>
                <option value="0">Deactive</option>';
    } else {

        $status = '<option value="1">Active</option>
                <option value="0" selected>Deactive</option>';
    }
} catch (PDOException $e) {
    echo "Error:" . $e->getMessage();
}

$conn = null;

?>

<body>

    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-12">

                <form action="update_users.php" method="POST" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-lg-7">

                            <input type="hidden" name="id" value="<?php echo $result[0]['id']; ?>">

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-outline mb-3">
                                        <label class="form-label" for="form6Example1">Full Name</label>
                                        <input type="text" name="full_name" value="<?php echo $result[0]['full_name']; ?>" id="form6Example1" class="form-control" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-outline mb-3">
                                        <label class="form-label" for="form6Example1">Email</label>
                                        <input type="email" name="email" value="<?php echo $result[0]['email']; ?>" id="form6Example1" class="form-control" />
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-outline mb-3">
                                        <label class="form-label" for="form6Example1">Password</label>
                                        <input type="password" name="password" value="<?php echo $result[0]['password']; ?>" id="form6Example1" class="form-control" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-outline mb-3">
                                        <label class="form-label" for="form6Example1">Phone Number</label>
                                        <input type="number" name="phone" value="<?php echo $result[0]['phone']; ?>" id="form6Example1" class="form-control" />
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="form6Example1">Role</label>
                                        <select class="form-select" name="role" value="<?php echo $result[0]['role']; ?>" aria-label="Default select example">
                                            <?php echo $role; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="form6Example1">Status</label>
                                        <select class="form-select" name="status" value="<?php echo $result[0]['status']; ?>" aria-label="Default select example">
                                            <?php echo $status; ?>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="form-outline mb-3">
                                <label class="form-label" for="customFile">Profile</label>
                                <input type="file" name="profile" value="admin_uploads/<?php echo $result[0]['profile']; ?>" id="form6Example1" class="form-control" />
                            </div>

                            <button type="submit" name="submit" class="btn btn-outline-success btn-block float-end mb-3">Save User</button>

                        </div>

                        <div class="col-lg-5 bg-light">
                            <img style="width: 250px;" class="img-fluid rounded mx-auto d-block m-5" src="admin_uploads/<?php echo $result[0]['profile']; ?>">
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- Footer Start -->
    <?php include_once '../admin/template/footer.php'; ?>
    <!-- End Footer -->

</body>

</html>