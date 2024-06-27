<?php
session_start();
include_once 'db_config.php';

if (!isset($_SESSION['UserId'])) {

    $navbar = '<div class="fas fa-sign-in-alt" id="login-btn"></div>
        <div class="fas fa-user" id="register-btn"></div>';
} else {

    $navbar = '<div class="fa-solid fa-address-card" id="view-btn"></div>';
}

if (isset($_SESSION['UserId'])) {

    $cookie = '
    <div class="hide" id="cookiePopup">
        <header>
            <i class="fa-solid fa-cookie-bite"></i>
            <h2>Cookies Consent</h2>
        </header>

        <div class="description">
             <p>
                Our website uses cookies to provide your browsing experience and
                relevant information. Before continuing to use our website, you agree &
                accept of our <a href="#">Cookie Policy & Privacy.</a>
            </p>
        </div>

        <div class="cookiebtn">
            <button class="acceptbtn" id="acceptCookie">Accept</button>
        </div>
    </div>';
}

try {

    $stmt = $conn->prepare("SELECT * FROM books 
    LEFT JOIN categories ON books.category_id = categories.category_id 
    LEFT JOIN authors ON books.author_id = authors.author_id WHERE books_status = '1' ORDER BY id DESC");
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    $allBooks = "";
    foreach ($result as $row) {
        $allBooks .= '
            <div class="item">
                <div class="work">
                    <div class="img d-flex align-items-end justify-content-center" style="background-image: url(admin/books_uploads/' . $row['images'] . ');">
                        <div class="text w-100">
                            <span class="cat1">' . $row['category_name'] . '</span>
                            <h3><a href="single.php?id=' . $row['id'] . '">' . $row['title'] . '</a></h3>
                            <h3><a href="single.php?id=' . $row['id'] . '">' . $row['author_name'] . '</a></h3>
                        </div>
                    </div>
                </div>
            </div>';
    }

    $stmt = $conn->prepare("SELECT * FROM books 
    LEFT JOIN categories ON books.category_id = categories.category_id 
    LEFT JOIN authors ON books.author_id = authors.author_id WHERE books_status = '1' && categories.category_id = 3  ORDER BY id DESC");
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $lresult = $stmt->fetchAll();

    $love = "";
    foreach ($lresult as $lrow) {
        $love .= '
            <div class="item">
                <div class="work">
                    <div class="img d-flex align-items-end justify-content-center" style="background-image: url(admin/books_uploads/' . $lrow['images'] . ');">
                        <div class="text w-100">
                            <span class="cat1">' . $lrow['category_name'] . '</span>
                            <h3><a href="single.php?id=' . $lrow['id'] . '">' . $lrow['title'] . '</a></h3>
                            <h3><a href="single.php?id=' . $lrow['id'] . '">' . $lrow['author_name'] . '</a></h3>
                        </div>
                    </div>
                </div>
            </div>';
    }

    $stmt = $conn->prepare("SELECT * FROM books 
    LEFT JOIN categories ON books.category_id = categories.category_id 
    LEFT JOIN authors ON books.author_id = authors.author_id WHERE books_status = '1' && categories.category_id = 4  ORDER BY id DESC");
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $hresult = $stmt->fetchAll();

    $horror = "";
    foreach ($hresult as $hrow) {
        $horror .= '
            <div class="item">
                <div class="work">
                    <div class="img d-flex align-items-end justify-content-center" style="background-image: url(admin/books_uploads/' . $hrow['images'] . ');">
                        <div class="text w-100">
                            <span class="cat1">' . $hrow['category_name'] . '</span>
                            <h3><a href="single.php?id=' . $hrow['id'] . '">' . $hrow['title'] . '</a></h3>
                            <h3><a href="single.php?id=' . $hrow['id'] . '">' . $hrow['author_name'] . '</a></h3>
                        </div>
                    </div>
                </div>
            </div>';
    }

    $stmt = $conn->prepare("SELECT * FROM books 
    LEFT JOIN categories ON books.category_id = categories.category_id 
    LEFT JOIN authors ON books.author_id = authors.author_id WHERE books_status = '1' && categories.category_id = 1  ORDER BY id DESC");
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $sresult = $stmt->fetchAll();

    $sciFi = "";
    foreach ($sresult as $srow) {
        $sciFi .= '
            <div class="item">
                <div class="work">
                    <div class="img d-flex align-items-end justify-content-center" style="background-image: url(admin/books_uploads/' . $srow['images'] . ');">
                        <div class="text w-100">
                            <span class="cat1">' . $srow['category_name'] . '</span>
                            <h3><a href="single.php?id=' . $srow['id'] . '">' . $srow['title'] . '</a></h3>
                            <h3><a href="single.php?id=' . $srow['id'] . '">' . $srow['author_name'] . '</a></h3>
                        </div>
                    </div>
                </div>
            </div>';
    }

    $stmt = $conn->prepare("SELECT * FROM books 
    LEFT JOIN categories ON books.category_id = categories.category_id 
    LEFT JOIN authors ON books.author_id = authors.author_id WHERE books_status = '1' && categories.category_id = 2  ORDER BY id DESC");
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $cresult = $stmt->fetchAll();

    $crime = "";
    foreach ($cresult as $crow) {
        $crime .= '
            <div class="item">
                <div class="work">
                    <div class="img d-flex align-items-end justify-content-center" style="background-image: url(admin/books_uploads/' . $crow['images'] . ');">
                        <div class="text w-100">
                            <span class="cat1">' . $crow['category_name'] . '</span>
                            <h3><a href="single.php?id=' . $crow['id'] . '">' . $crow['title'] . '</a></h3>
                            <h3><a href="single.php?id=' . $crow['id'] . '">' . $crow['author_name'] . '</a></h3>
                        </div>
                    </div>
                </div>
            </div>';
    }

    $stmt = $conn->prepare("SELECT * FROM categories WHERE status = '1' ORDER BY category_id DESC");
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $categoryResult = $stmt->fetchAll();

    $category = "";
    foreach ($categoryResult as $categoryRow) {
        $category .= '
        <div class="box">
            <h3>' . $categoryRow['category_name'] . '</h3>
            <a href="category.php?id=' . $categoryRow['category_id'] . '" class="button">view category</a>
        </div>';
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>

<!-- Header Start -->
<?php include_once 'template/header.php'; ?>
<!-- End Header -->

<!-- Navbar Start -->
<?php include_once 'template/navbar.php'; ?>
<!-- End Navbar -->

<!-- home section starts  -->
<section class="home" id="home">
    <div class="content">
        <h3>the <span>online library</span> in sri lanka</h3>
        <p>the online library, founded in 2002, is a book lover's dream.
            It's the world's largest library with 02 million items and 11 kilometres of bookshelves.</p>
        <a href="#" class="homebtn">today buy now</a>
    </div>
</section>

<!-- Icons Start -->
<?php include_once 'template/icons.php'; ?>
<!-- End Icons -->

<!-- Carousel Start -->
<section class="ftco-section">
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <h1 class="heading"> all <span>books</span> </h1>
                <div class="featured-carousel owl-carousel mb-4">
                    <?php echo $allBooks; ?>
                </div>

                <h1 class="heading"> love <span>books</span> </h1>
                <div class="featured-carousel owl-carousel mb-4">
                    <?php echo $love; ?>
                </div>

                <h1 class="heading"> horror <span>books</span> </h1>
                <div class="featured-carousel owl-carousel mb-4">
                    <?php echo $horror; ?>
                </div>

                <h1 class="heading"> sci-fi <span>books</span> </h1>
                <div class="featured-carousel owl-carousel mb-4">
                    <?php echo $sciFi; ?>
                </div>

                <h1 class="heading"> crime <span>books</span> </h1>
                <div class="featured-carousel owl-carousel mb-4">
                    <?php echo $crime; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- categories section starts  -->
<section class="categories mb-5" id="categories">
    <h1 class="heading"> books <span>categories</span> </h1>

    <div class="box-container">
        <?php echo $category; ?>
    </div>
</section>

<!-- Cookie Start -->
<?php echo $cookie; ?>

<!-- Footer Start -->
<?php include_once 'template/footer.php'; ?>
<!-- End Footer -->