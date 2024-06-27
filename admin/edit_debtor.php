<?php

include_once '../db_config.php';
$id = $_GET['id'];

try {

    // Lendings Select Quarry
    $stmt = $conn->prepare("SELECT * FROM lendings 
    LEFT JOIN books ON lendings.book_id = books.id 
    LEFT JOIN users ON lendings.user_id = users.id WHERE lendings.lend_id = $id");
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    if ($result[0]['lendings_status'] == '1') {

        $lendings_status = '<option value="1" selected>Approved</option>
                <option value="0">Unapproved</option>';
    } else {

        $lendings_status = '<option value="1">Approved</option>
                <option value="0" selected>Unapproved</option>';
    }
} catch (PDOException $e) {
    $e->getMessage();
}

$conn = null;

?>

<!-- Header Start -->
<?php include_once '../admin/template/header.php'; ?>
<!-- End Header -->

<body>

    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-6">

                <form action="update_debtor.php" method="POST">

                    <input type="hidden" name="lend_id" value="<?php echo $result[0]['lend_id']; ?>">

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-outline mb-3">
                                <label class="form-label" for="form6Example6">Book Title</label>
                                <input type="text" readonly="" name="title" value="<?php echo $result[0]['title']; ?>" id="form6Example6" class="form-control" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-outline mb-3">
                                <label class="form-label" for="form6Example6">User Name</label>
                                <input type="text" readonly="" name="full_name" value="<?php echo $result[0]['full_name']; ?>" id="form6Example6" class="form-control" />
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" for="form6Example1">Lendings Status</label>
                                <select class="form-select" name="lendings_status" value="<?php echo $result[0]['lendings_status']; ?>" aria-label="Default select example">
                                    <?php echo $lendings_status; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-outline mb-3">
                                <label class="form-label" for="customFile">Given Date</label>
                                <input type="date" name="given_date" value="<?php echo $result[0]['given_date']; ?>" id="form6Example1" class="form-control" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-outline mb-3">
                                <label class="form-label" for="form6Example1">Received Date</label>
                                <input type="date" name="received_date" value="<?php echo $result[0]['received_date']; ?>" id="form6Example1" class="form-control" />
                            </div>
                        </div>

                    </div>

                    <button type="submit" name="submit" class="btn btn-outline-success btn-block float-end mb-3">Save Debtor</button>

                </form>

            </div>
        </div>
    </div>

    <!-- Footer Start -->
    <?php include_once '../admin/template/footer.php'; ?>
    <!-- End Footer -->

</body>

</html>