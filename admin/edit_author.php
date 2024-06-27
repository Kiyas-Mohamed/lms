<!-- Header Start -->
<?php include_once '../admin/template/header.php'; ?>
<!-- End Header -->

<?php

include_once '../db_config.php';

$author_id = $_GET['author_id'];

try {

    $stmt = $conn->prepare("SELECT * FROM authors where author_id = $author_id");
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

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

                <form action="update_author.php" method="POST" enctype="multipart/form-data">

                    <div class="row">

                        <div class="col-lg-7">
                            <input type="hidden" name="author_id" value="<?php echo $result[0]['author_id']; ?>" />

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-outline mb-3">
                                        <label class="form-label" for="form6Example1">Author Name</label>
                                        <input type="text" name="author_name" value="<?php echo $result[0]['author_name']; ?>" id="form6Example1" class="form-control" />
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
                                <input type="file" name="profile" value="<?php echo $result[0]['profile']; ?>" id="form6Example1" class="form-control" />
                            </div>

                            <button type="submit" name="submit" class="btn btn-outline-success btn-block float-end mb-3">Save Author</button>
                        </div>

                        <div class="col-lg-5 bg-light">
                            <img style="width: 250px;" class="img-fluid rounded mx-auto d-block m-5" src="authors_uploads/<?php echo $result[0]['profile']; ?>">
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