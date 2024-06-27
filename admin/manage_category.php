<!-- Header Start -->
<?php include_once '../admin/template/header.php'; ?>
<!-- End Header -->

<body>

    <!-- Bootstrap only -->
    <link href="../admin/assets/css/bootstrap.min.css" rel="stylesheet">

    <?php

    include_once '../db_config.php';

    try {

        if (isset($_POST['submit'])) {

            $stmt = $conn->prepare("SELECT category_name FROM categories WHERE category_name = :category_name");
            $stmt->execute(array('category_name' => $_POST['category_name']));

            $check = $stmt->rowCount();
            if ($check > 0) {

                $e = '<div class="alert alert-danger h6" role="alert"><i class="fa-solid fa-xmark"></i> This <b>Category</b> Already Exists</div>';
            } else {

                $stmt = $conn->prepare("INSERT INTO categories (category_name, status) VALUES (:category_name, :status)");

                $stmt->bindParam(':category_name', $category_name);
                $stmt->bindParam(':status', $status);

                $category_name = $_POST['category_name'];
                $status = $_POST['status'];
                $stmt->execute();

                $d = '<div class="alert alert-success h6" role="alert"><i class="fa-solid fa-check"></i> New Category <b>Added</b> Successfully</div>';
            }
        }

        // Select Quarry
        $stmt = $conn->prepare("SELECT * FROM categories ORDER BY category_id DESC");
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();

    ?>

        <div class="container mt-4">
            <div class="row">

                <div class="row">

                    <div class="col-md-2">
                        <span class="d-grid gap-2 d-md-flex ">
                            <a href="dashboard.php" class="btn btn-dark btn-sm">
                                <i class="fa-solid fa-arrow-left-long"></i> Back
                            </a>
                        </span>
                    </div>

                    <div class="col-md-2"></div>
                    <div class="col-md-2"></div>
                    <div class="col-md-2"></div>
                    <div class="col-md-2"></div>

                    <div class="col-md-2">
                        <!-- Add Button 1 -->
                        <span class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <span class="h6">
                                    <i class="fa-solid fa-list"></i> Add New Category
                                </span>
                            </button>
                        </span>
                    </div>

                </div>

                <div>
                    <!-- Error Msg -->
                    <?php
                    if (isset($e)) {

                        echo $e;
                    }
                    ?>

                    <!-- Success Msg -->
                    <?php
                    if (isset($d)) {

                        echo $d;
                    }
                    ?>
                </div>

                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    CategoriseTable
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <table id="datatablesSimple">

                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Name</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Updated</th>
                                    <th>Options</th>
                                </tr>
                            </thead>

                            <?php
                            foreach ($result as $row) {

                                if ($row['status'] == '1') {

                                    $status = 'Active';
                                } else {

                                    $status = 'Deactive';
                                }

                            ?>

                                <tbody>
                                    <tr>
                                        <td align="center">
                                            <?php echo $row['category_id']; ?>
                                        </td>
                                        <td align="center">
                                            <?php echo $row['category_name']; ?>
                                        </td>
                                        <td align="center">
                                            <?php echo $status; ?>
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
                                                        <a href="edit_category.php?category_id=<?php echo $row['category_id']; ?>" class="btn btn-success btn-sm">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <!-- Delete Link Button -->
                                                        <a href="dlt_category.php?category_id=<?php echo $row['category_id']; ?>" class="btn btn-danger btn-sm">
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

    <!-- Add Form -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">

                <!-- Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-list"></i> Add New Category
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal -->
                <div class="modal-body">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

                        <div class="form-outline mb-3">
                            <label class="form-label" for="form6Example1">Category Name</label>
                            <input type="text" name="category_name" required="require" id="form6Example1" class="form-control" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="form6Example1">Status</label>
                            <select class="form-select" name="status" aria-label="Default select example">
                                <option value="1">Active</option>
                                <option value="0" selected>Deactive</option>
                            </select>
                        </div>

                        <!-- Button -->
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
                            <button type="submit" class="btn btn-outline-success btn-sm " name="submit"><i class="fa-solid fa-list"></i> Add Category</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

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