<!-- Header Start -->
<?php include_once '../admin/template/header.php'; ?>
<!-- End Header -->

<body>

    <!-- Bootstrap only -->
    <link href="../admin/assets/css/bootstrap.min.css" rel="stylesheet">

    <?php

    include_once '../db_config.php';

    try {

        // Lendings Select Quarry
        $stmt = $conn->prepare("SELECT * FROM lendings 
        LEFT JOIN books ON lendings.book_id = books.id 
        LEFT JOIN users ON lendings.user_id = users.id ORDER BY lendings.lend_id DESC");
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();

    ?>

        <div class="container mt-4">
            <div class="row">

                <div class="row">

                    <div class="col-md-2">
                        <span class="d-grid gap-2 d-md-flex mb-2">
                            <a href="dashboard.php" class="btn btn-dark btn-sm">
                                <i class="fa-solid fa-arrow-left-long"></i> Back
                            </a>
                        </span>
                    </div>

                    <div class="col-md-2"></div>
                    <div class="col-md-2"></div>
                    <div class="col-md-2"></div>
                    <div class="col-md-2"></div>
                    <div class="col-md-2"></div>
                </div>

                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    LendingsTable
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <table id="datatablesSimple">

                            <thead>
                                <tr>
                                    <th>Lend ID</th>
                                    <th>Book Title</th>
                                    <th>User Name</th>
                                    <th>Lendings Status</th>
                                    <th>Given Date</th>
                                    <th>Received Date</th>
                                    <th>Created</th>
                                    <th>Updated</th>
                                    <th>Options</th>
                                </tr>
                            </thead>

                            <?php
                            foreach ($result as $row) {
                                if ($row['lendings_status'] == '1') {

                                    $lendings_status = "Approved";
                                } else {

                                    $lendings_status = "Unapproved";
                                }
                            ?>

                                <tbody>
                                    <tr>
                                        <td align="center">
                                            <?php echo $row['lend_id']; ?>
                                        </td>
                                        <td align="center">
                                            <?php echo $row['title']; ?>
                                        </td>
                                        <td align="center">
                                            <?php echo $row['full_name']; ?>
                                        </td>
                                        <td align="center">
                                            <?php echo $lendings_status; ?>
                                        </td>
                                        <td align="center">
                                            <?php echo $row['given_date']; ?>
                                        </td>
                                        <td align="center">
                                            <?php echo $row['received_date']; ?>
                                        </td>
                                        <td align="center">
                                            <?php echo $row['created_at']; ?>
                                        </td>
                                        <td align="center">
                                            <?php echo $row['updated_at']; ?>
                                        </td>

                                        <td class="p-4">
                                            <div class="btn-group dropend">
                                                <button type="button" class="btn btn-primary dropdown-toggle btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Actions
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li style="text-align: center;">
                                                        <!-- Edit Link Button -->
                                                        <a href="edit_debtor.php?id=<?php echo $row['lend_id']; ?>" class="btn btn-success btn-sm">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <!-- Delete Link Button -->
                                                        <a href="dlt_debtor.php?id=<?php echo $row['lend_id']; ?>" class="btn btn-danger btn-sm">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>

                                    </tr>
                                </tbody>

                            <?php
                            }
                            ?>

                        </table>
                    </div>
                </div>

            </div>
        </div>

    <?php

    } catch (PDOException $e) {
        echo "Error:" . $e->getMessage();
    }

    ?>

    <!-- Footer Start -->
    <?php include_once '../admin/template/footer.php'; ?>
    <!-- End Footer -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>

    <!-- Bootstrap only -->
    <script src="../admin/assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/datatables-simple-demo.js"></script>

    <script src="assets/js/scripts.js"></script>

</body>

</html>