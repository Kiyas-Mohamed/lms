<?php

include_once 'db_config.php';
$id = $_GET['id'];

try {

    $stmt = $conn->prepare("SELECT * FROM books 
    LEFT JOIN categories ON books.category_id = categories.category_id 
    LEFT JOIN authors ON books.author_id = authors.author_id WHERE categories.category_id = $id");
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $categoryResult = $stmt->fetchAll();

    $booksCategory = "";
} catch (PDOException $e) {
    echo "" . $e->getMessage();
}

$conn = null;

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

<!-- Content Start -->
<div class="row">
    <!-- Blog entries-->
    <div class="col-lg-12">
        <div class="row">
            <!-- Blog post-->
            <?php foreach ($categoryResult as $categoryRow) : ?>

                <div class="card mb-4 mx-3">
                    <a href="#"><img class="card-img-top" src="admin/books_uploads/<?php echo $categoryRow['images']; ?>"></a>
                    <div class="card-body">
                        <div class="h5 text-muted"><i class="fa-solid fa-calendar-days"></i> <?php echo $categoryRow['updated_at']; ?></div>
                        <h2 class="card-title h3"><?php echo $categoryRow['title']; ?></h2>
                        <a class="button" href="single.php?id=<?php echo $categoryRow['id']; ?>">Read More <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Footer Start -->
<?php include_once 'template/footer.php'; ?>
<!-- End Footer -->