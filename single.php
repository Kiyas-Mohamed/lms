<?php
session_start();
include_once 'db_config.php';
$id = $_GET['id'];

try {

    $stmt = $conn->prepare("SELECT * FROM books 
    LEFT JOIN categories ON books.category_id = categories.category_id 
    LEFT JOIN authors ON books.author_id = authors.author_id WHERE id = $id");
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    $img = "";
    $specifications = "";
    $description = "";
    foreach ($result as $row) {

        $img = '<img style="width: 260px; height: 380px;" class="img-fluid rounded" src="admin/books_uploads/' . $row['images'] . '">';

        $specifications = '<div class="pt-3 mb-2 h1">Date Of Release: </div>
        <input class="box" type="text" readonly="" value="' . $row['updated_at'] . '">

        <div class="pt-3 mb-2 h1">Author Name: </div>
        <input class="box" type="text" readonly="" value="' . $row['author_name'] . '">

        <div class="pt-3 mb-2 h1">Book Name: </div>
        <input class="box" type="text" readonly="" value="' . $row['title'] . '">

        <div class="pt-3 mb-2 h1">Book Category: </div>
        <input class="box" type="text" readonly="" value="' . $row['category_name'] . '">';

        $description = '<div class="heading h1">Book <span>Description</span></div>
            <div class="col-lg">
                 <textarea class="box mt-2 mb-1" readonly="" rows="8">' . $row['description'] . '</textarea>
            </div>';
    }

    $sendRequest = "";
    if (isset($_POST['request'])) {

        $userId = $_SESSION['UserId'];

        $stmt = $conn->prepare("INSERT INTO lendings (book_id, user_id) VALUES ($id, $userId)");
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $requestResult = $stmt->fetchAll();

        $sendRequest = '
                <div class="alert alert-success mb-4" role="alert">
                <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
                    <h1 class="alert-heading">Well Done!</h1>
                    <p class="mb-0"><b>' . $_SESSION['UserFullName'] . '</b> your <b>request</b> was send successfully<span>...</span></p>
                </div>';
    }

    $button = "";
    if (isset($_SESSION['UserId'])) {

        $button = '<h5 class="wantBook">if you want this book <br> please request <br> <span class="fa-solid fa-hand-point-down"></span></h5>
        <center><input type="submit" class="request" name="request" value="request"></center>';
    } else {

        $button = '<h5>if you want this book <br> please register <br> <span class="fa-solid fa-hand-point-down"></span></h5>
        <center><a class="register" name="register" href="index.php">Register</a></center>';
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

<style>
    .row {
        margin-top: 100px;
        margin-bottom: 25px;
    }

    .container .row img {
        box-shadow: rgba(17, 17, 26, 0.1) 0px 4px 16px, rgba(17, 17, 26, 0.05) 0px 8px 32px;
        cursor: pointer;
        transition: 0.5s;
    }

    .container .row img:hover {
        transform: translateY(5px);
    }

    .container .row .box {
        border-radius: 8px;
        padding: 2px;
        font-size: 1.6rem;
        outline: none;
        border: none;
        background: none;
    }

    .container .row textarea {
        width: 90%;
        text-align: justify;
        font-size: 1.6rem;
        outline: none;
        border: none;
    }

    .container .row .request {
        display: inline-block;
        padding: .5rem 3rem;
        font-size: 1.8rem;
        border-radius: 18px;
        box-shadow: rgba(17, 17, 26, 0.1) 0px 4px 16px, rgba(17, 17, 26, 0.05) 0px 8px 32px;
        color: #fff;
        cursor: pointer;
        background: #ff7800;
    }

    .container .row .request:hover {
        background: none;
        color: var(--orange);
    }

    .container .row h5 {
        text-align: center;
        font-size: 15px;
        font-weight: 600;
        padding: 5px;
        color: red;
    }

    .container .row .wantBook {
        text-align: center;
        font-size: 15px;
        font-weight: 600;
        padding: 5px;
        color: green;
    }

    .container .row h5 span {
        font-size: 30px;
        padding-top: 5px;
    }

    .container .row .register {
        display: inline-block;
        padding: .5rem 3rem;
        font-size: 1.8rem;
        border-radius: 18px;
        box-shadow: rgba(17, 17, 26, 0.1) 0px 4px 16px, rgba(17, 17, 26, 0.05) 0px 8px 32px;
        color: #fff;
        cursor: pointer;
        background: #ff7800;
    }

    .container .row .register:hover {
        background: none;
        color: var(--orange);
    }

    .container .row .alert .alert-heading {
        font-size: 30px;
        font-weight: 500;
    }

    .container .row .alert p {
        font-size: 16px;
        font-weight: 400;
    }

    .container .row .alert button {
        font-size: 18px;
        padding-top: 10px;
        padding-right: 5px;
    }
</style>

<div class="container">

    <div class="row">
        <div class="col-lg text-center">
            <img style="width: 500px; height: 130px;" src="admin/assets/img/advertisement.jpg">
            <span class="h1 ps-3">advertisement</span>
        </div>
    </div>

    <div class="row">
        <h1 class="heading mb-1 text-center">book <span>specifications</span></h1>

        <div class="row mt-5">
            <div class="col-lg-1"></div>

            <div class="col-lg-10">
                <?php echo $sendRequest; ?>
            </div>

            <div class="col-lg-1"></div>
        </div>

        <div class="col-lg-4">
            <center>
                <?php echo $img; ?>
            </center>
        </div>

        <div class="col-lg-8 h2">
            <div class="pb-3"></div>
            <?php echo $specifications; ?>
        </div>

        <div class="row mt-5">
            <div class="col-lg-4">

                <form action="" method="POST">
                    <?php echo $button; ?>
                </form>

            </div>
            <div class="col-lg-8"></div>
        </div>

        <div class="row mt-3">
            <center>
                <?php echo $description; ?>
            </center>
        </div>
    </div>
</div>

<!-- Footer Start -->
<?php include_once 'template/footer.php'; ?>
<!-- End Footer -->