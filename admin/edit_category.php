<!-- Header Start -->
<?php include_once '../admin/template/header.php'; ?>
<!-- End Header -->

<?php

include_once '../db_config.php';

$category_id = $_GET['category_id'];

try {

    $stmt = $conn->prepare("SELECT * FROM categories where category_id = $category_id");
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
            <div class="col-lg-6">

                <form action="update_category.php" method="POST">

                    <input type="hidden" name="category_id" value="<?php echo $result[0]['category_id']; ?>" />

                    <div class="form-outline mb-3">
                        <label class="form-label" for="form6Example1">Category Name</label>
                        <input type="text" name="category_name" value="<?php echo $result[0]['category_name']; ?>" id="form6Example1" class="form-control" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="form6Example1">Status</label>
                        <select class="form-select" name="status" value="<?php echo $result[0]['status']; ?>" aria-label="Default select example">
                            <?php echo $status; ?>
                        </select>
                    </div>

                    <button type="submit" name="submit" class="btn btn-outline-success btn-block float-end mb-3">Save Category</button>

                </form>

            </div>
        </div>
    </div>

    <!-- Footer Start -->
    <?php include_once '../admin/template/footer.php'; ?>
    <!-- End Footer -->

</body>

</html>