<!-- Header Start -->
<?php include_once '../admin/template/header.php'; ?>
<!-- End Header -->

<?php

include_once '../db_config.php';
$id = $_GET['id'];

try {

    $stmt = $conn->prepare("SELECT * FROM fines WHERE id = $id");
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error:" . $e->getMessage();
}

$conn = null;

?>

<body>

    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-6">

                <form action="update_fines.php" method="POST">

                    <input type="hidden" name="id" value="<?php echo $result[0]['id']; ?>">

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-outline mb-3">
                                <label class="form-label" for="form6Example6">Book ID</label>
                                <input type="number" name="book_id" value="<?php echo $result[0]['book_id']; ?>" maxlength="11" id="form6Example6" class="form-control" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-outline mb-3">
                                <label class="form-label" for="form6Example6">User ID</label>
                                <input type="number" name="user_id" value="<?php echo $result[0]['user_id']; ?>" maxlength="11" id="form6Example6" class="form-control" />
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-outline mb-3">
                                <label class="form-label" for="form6Example1">Fine Amount</label>
                                <input type="number" name="amount" value="<?php echo $result[0]['amount']; ?>" id="form6Example1" class="form-control" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-outline mb-3">
                                <label class="form-label" for="customFile">Fine Date</label>
                                <input type="date" name="fine_date" value="<?php echo $result[0]['fine_date']; ?>" class="form-control" id="customFile" />
                            </div>
                        </div>

                    </div>

                    <button type="submit" name="submit" class="btn btn-outline-success btn-block float-end mb-3">Save Fine</button>

                </form>

            </div>
        </div>
    </div>

    <!-- Footer Start -->
    <?php include_once '../admin/template/footer.php'; ?>
    <!-- End Footer -->

</body>

</html>