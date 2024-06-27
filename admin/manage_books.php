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

                $stmt = $conn->prepare("SELECT title FROM books WHERE title = :title");
                $stmt->execute(array('title' => $_POST['title']));

                $check = $stmt->rowCount();
                if ($check > 0) {

                    $e = '<div class="alert alert-danger h6" role="alert"><i class="fa-solid fa-xmark"></i> This <b>Book</b> Already Exists</div>';
                } else {

                    $stmt = $conn->prepare("INSERT INTO books (title, description, quantity, books_status, category_id, author_id) 
                    VALUES (:title, :description, :quantity, :books_status, :category_name, :author_name)");

                    $stmt->bindParam(':title', $title);
                    $stmt->bindParam(':description', $description);
                    $stmt->bindParam(':quantity', $quantity);
                    $stmt->bindParam(':books_status', $books_status);
                    $stmt->bindParam(':category_name', $category_name);
                    $stmt->bindParam(':author_name', $author_name);

                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $quantity = $_POST['quantity'];
                    $books_status = $_POST['books_status'];
                    $category_name = $_POST['category_name'];
                    $author_name = $_POST['author_name'];
                    $stmt->execute();

                    $img = $_FILES['images'];

                    $imgName = $_FILES['images']['name'];
                    $imgTmpName = $_FILES['images']['tmp_name'];
                    $imgSize = $_FILES['images']['size'];
                    $imgError = $_FILES['images']['error'];
                    $imgType = $_FILES['images']['type'];

                    $imgExt = explode('.', $imgName);
                    $last_id = $conn->lastInsertId();
                    $imgActualExt = strtolower(end($imgExt));

                    $allow = array('png', 'jpg', 'jpeg');
                    if (in_array($imgActualExt, $allow)) {

                        if ($imgError === 0) {

                            if ($imgSize < 10000000) {
                                $imgNameNew = $last_id . "." . $imgActualExt;
                                $imgDestination = 'books_uploads/' . $imgNameNew;
                                move_uploaded_file($imgTmpName, $imgDestination);

                                $stmt = $conn->prepare("UPDATE books SET images = '$imgNameNew' WHERE id = '$last_id'");
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

                    $d = '<div class="alert alert-success h6" role="alert"><i class="fa-solid fa-check"></i> New Book <b>Added</b> Successfully</div>';
                }
            }

            // Books Select Quarry
            $stmt = $conn->prepare("SELECT * FROM books 
            LEFT JOIN categories ON books.category_id = categories.category_id 
            LEFT JOIN authors ON books.author_id = authors.author_id ORDER BY id DESC");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();

            // Categories Select Quarry
            $stmt = $conn->prepare("SELECT * FROM categories ORDER BY category_id DESC");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $cresult = $stmt->fetchAll();

            $category_name = "";
            foreach ($cresult as $crow) {

                $category_name .= '<option value="' . $crow['category_id'] . '">' . $crow['category_name'] . '</option>';
            }

            // Authors Select Quarry
            $stmt = $conn->prepare("SELECT * FROM authors ORDER BY author_id DESC");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $aresult = $stmt->fetchAll();

            $author_name = "";
            foreach ($aresult as $arow) {

                $author_name .= '<option value="' . $arow['author_id'] . '">' . $arow['author_name'] . '</option>';
            }

        ?>

            <div class="container mt-4">
                <div class="row">

                    <div class="row">

                        <div class="col-md-2">
                            <span class="d-grid gap-2 d-md-flex">
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
                                        <i class="fa-solid fa-book"></i> Add New Book
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
                        BooksTable
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">

                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Images</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Category Name</th>
                                        <th>Author Name</th>
                                        <th>Qnt</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Updated</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>

                                <?php
                                foreach ($result as $row) {
                                    if ($row['books_status'] == '1') {

                                        $books_status = "Published";
                                    } else {

                                        $books_status = "Unpublished";
                                    }
                                ?>

                                    <tbody>
                                        <tr>
                                            <td align="center">
                                                <?php echo $row['id']; ?>
                                            </td>
                                            <td style="max-width: 70px;">
                                                <img class="img-fluid rounded" src="books_uploads/<?php echo $row['images']; ?>">
                                            </td>
                                            <td>
                                                <?php echo $row['title']; ?>
                                            </td>
                                            <td>
                                                <?php echo substr($row['description'], 0, 80); ?>
                                            </td>
                                            <td align="center">
                                                <?php echo $row['category_name']; ?>
                                            </td>
                                            <td align="center">
                                                <?php echo $row['author_name']; ?>
                                            </td>
                                            <td align="center">
                                                <?php echo $row['quantity']; ?>
                                            </td>
                                            <td align="center">
                                                <?php echo $books_status; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['created_at']; ?>
                                            </td>
                                            <td>
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
                                                            <a href="edit_books.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                            </a>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <!-- Delete Link Button -->
                                                            <a href="dlt_books.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">
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
            echo "Error: " . $e->getMessage();
        }

        ?>

        <!-- Add Form -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                <div class="modal-content">

                    <!-- Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-book"></i> Add New Book
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal -->
                    <div class="modal-body">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">

                            <div class="form-outline mb-3">
                                <label class="form-label" for="form6Example1">Title</label>
                                <input type="text" name="title" required="require" id="form6Example1" class="form-control" />
                            </div>

                            <div class="form-outline mb-3">
                                <label class="form-label" for="form6Example7">Description</label>
                                <textarea class="form-control" name="description" required="require" id="form6Example7" rows="4"></textarea>
                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="form6Example1">Category Name</label>
                                        <select class="form-select" name="category_name" aria-label="Default select example">
                                            <?php echo $category_name; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="form6Example1">Author Name</label>
                                        <select class="form-select" name="author_name" aria-label="Default select example">
                                            <?php echo $author_name; ?>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="form6Example1">Quantity</label>
                                        <select class="form-select" name="quantity" required="require" aria-label="Default select example">
                                            <option value="1" selected>1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="form6Example1">Status</label>
                                        <select class="form-select" name="books_status" required="require" aria-label="Default select example">
                                            <option value="1">Published</option>
                                            <option value="0" selected>Unpublished</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="form-outline mb-3">
                                <label class="form-label" for="customFile">Image</label>
                                <input type="file" name="images" required="require" class="form-control" id="customFile" />
                            </div>

                            <!-- Button -->
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
                                <button type="submit" class="btn btn-outline-success btn-sm " name="submit"><i class="fa-solid fa-book"></i> Add Book</button>
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