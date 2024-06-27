<?php
session_start();
include_once 'db_config.php';

// Search Form Results
if (isset($_POST['search'])) {

    $key = $_POST['key'];

    $stmt = $conn->prepare("SELECT * FROM books 
    LEFT JOIN categories ON books.category_id = categories.category_id
    LEFT JOIN authors ON books.author_id = authors.author_id WHERE title LIKE :keyword");
    $stmt->bindValue(':keyword', '%' . $key . '%', PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetchAll();
    $checksearch = $stmt->rowCount();

    $error = "";
    if (!$checksearch = 0) {

        $success = "";
        foreach ($result as $row) {

            $success = '
                <div class="card mb-4 mx-3">
                    <a href="#">
                        <img class="card-img-top" src="admin/books_uploads/' . $row['images'] . '">
                    </a>
                    <div class="card-body">
                        <div class="h5 text-muted"><i class="fa-solid fa-calendar-days"></i> ' . $row['category_name'] . '</div>
                        <h2 class="card-title h3">' . $row['title'] . '</h2>
                        <h2 class="card-title h3">' . $row['author_name'] . '</h2>
                        <a class="button" href="single.php?id= ' . $row['id'] . '">Read More <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>';
        }
    } else {

        $error = '<h4 class="text-danger text-center h4">no <b>result</b> was <b>found</b> for your search!</h4>';
    }
}

?>

<!-- Header Start -->
<?php include_once 'template/header.php'; ?>
<!-- End Header -->

<!-- Navbar Start -->
<?php include_once 'template/navbar.php'; ?>
<!-- End Navbar -->

<style>
    .row {
        margin: 70px 60px;
    }

    .row .card {
        width: 300px;
    }

    .row .card img {
        height: 390px;
    }

    .row .card .card-body .card-title {
        margin-top: 10px;
        margin-bottom: 0;
    }
</style>

<div class="row">
    <!-- Blog entries-->
    <div class="col-lg-12">
        <div class="row">

            <!-- Blog post-->
            <?php
            if (isset($success)) {

                echo $success;
            }
            ?>

            <?php
            if (isset($error)) {

                echo $error;
            }
            ?>

        </div>
    </div>
</div>

<!-- Footer Start -->
<?php include_once 'template/footer.php'; ?>
<!-- End Footer -->