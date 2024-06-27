<?php

include_once '../db_config.php';
$id = $_GET['id'];

try {

    // Book Select Quarry
    $stmt = $conn->prepare("SELECT * FROM books
    LEFT JOIN categories ON books.category_id = categories.category_id 
    LEFT JOIN authors ON books.author_id = authors.author_id WHERE books.id = $id");
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

        if ($result[0]['category_id'] == $crow['category_id']) {

            $category_name .= '<option value="' . $crow['category_id'] . '" selected>' . $crow['category_name'] . '</option>';
        } else {

            $category_name .= '<option value="' . $crow['category_id'] . '">' . $crow['category_name'] . '</option>';
        }
    }

    // Authors Select Quarry
    $stmt = $conn->prepare("SELECT * FROM authors ORDER BY author_id DESC");
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $aresult = $stmt->fetchAll();

    $author_name = "";
    foreach ($aresult as $arow) {

        if ($result[0]['author_id'] == $arow['author_id']) {

            $author_name .= '<option value="' . $arow['author_id'] . '" selected>' . $arow['author_name'] . '</option>';
        } else {

            $author_name .= '<option value="' . $arow['author_id'] . '">' . $arow['author_name'] . '</option>';
        }
    }

    if ($result[0]['books_status'] == '1') {

        $books_status = '<option value="1" selected>Published</option>
                        <option value="0">Unpublished</option>';
    } else {

        $books_status = '<option value="1">Published</option>
                        <option value="0" selected>Unpublished</option>';
    }

    if ($result[0]['quantity'] == '1') {

        $quantity = '<option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>';
    } elseif ($result[0]['quantity'] == '2') {

        $quantity = '<option value="1">1</option>
                            <option value="2" selected>2</option>
                            <option value="3">3</option>';
    } elseif ($result[0]['quantity'] == '3') {

        $quantity = '<option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3" selected>3</option>';
    }
} catch (PDOException $e) {
    echo "Error:" . $e->getMessage();
}

$conn = null;

?>

<!-- Header Start -->
<?php include_once '../admin/template/header.php'; ?>
<!-- End Header -->

<body>

    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-12">

                <form action="update_books.php" method="POST" enctype="multipart/form-data">
                    <div class="row">

                        <div class="col-lg-7">
                            <input type="hidden" name="id" value="<?php echo $result[0]['id']; ?>" />

                            <div class="form-outline mb-3">
                                <label class="form-label" for="form6Example1">Title</label>
                                <input type="text" name="title" value="<?php echo $result[0]['title']; ?>" id="form6Example1" class="form-control" />
                            </div>

                            <div class="form-outline mb-3">
                                <label class="form-label" for="form6Example7">Description</label>
                                <textarea class="form-control" name="description" id="form6Example7" rows="4"><?php echo $result[0]['description']; ?></textarea>
                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="form6Example1">Category Name</label>
                                        <select class="form-select" name="category_name" value="<?php echo $cresult[0]['category_name']; ?>" aria-label="Default select example">
                                            <?php echo $category_name; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="form6Example1">Author Name</label>
                                        <select class="form-select" name="author_name" value="<?php echo $aresult[0]['author_name']; ?>" aria-label="Default select example">
                                            <?php echo $author_name; ?>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="form6Example1">Quantity</label>
                                        <select class="form-select" name="quantity" value="<?php echo $result[0]['quantity']; ?>" aria-label="Default select example">
                                            <?php echo $quantity; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="form6Example1">Status</label>
                                        <select class="form-select" name="books_status" value="<?php echo $result[0]['books_status']; ?>" aria-label="Default select example">
                                            <?php echo $books_status; ?>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="form-outline mb-3">
                                <label class="form-label" for="customFile">Image</label>
                                <input type="file" name="images" id="form6Example1" class="form-control" />
                            </div>

                            <button type="submit" name="submit" class="btn btn-outline-success btn-block float-end mb-2">Save Book</button>
                        </div>

                        <!-- Preview Image -->
                        <div class="col-lg-5 bg-light">
                            <img style="width: 250px;" class="img-fluid rounded mx-auto d-block m-5" src="books_uploads/<?php echo $result[0]['images']; ?>">
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