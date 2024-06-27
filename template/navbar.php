<?php
include_once 'db_config.php';

if (!isset($_SESSION['UserId'])) {

    $navbar = '<div class="fas fa-sign-in-alt" id="login-btn"></div>
        <div class="fas fa-user" id="register-btn"></div>';
} else {

    $navbar = '<div class="fa-solid fa-address-card" id="view-btn"></div>';
}
?>

<style>
    .header .view-btn img {
        width: 98px;
        margin-bottom: 8px;
        border: 3px solid #ff7800;
        box-shadow: 0 .5rem 1.5rem rgba(0, 0, 0, .3);
        transition: 0.5s;
    }

    .header .view-btn img:hover {
        transform: translateY(3px);
        cursor: pointer;
    }

    .header .search-form button {
        background: none;
        outline: none;
        border: none;
        margin-top: 3px;
        padding: 5px;
    }
</style>

<!-- header section starts  -->
<header class="header">
    <a href="#" class="logo"> <i class="fas fa-book"></i> online library </a>

    <nav class="navbar">
        <a href="#home">home</a>
        <a href="#features">features</a>
        <a href="#books">books</a>
        <a href="#categories">categories</a>
    </nav>

    <div class="icons">
        <div class="fas fa-bars" id="menu-btn"></div>
        <div class="fas fa-search" id="search-btn"></div>
        <?php echo $navbar; ?>
    </div>

    <!-- Serch Result Button -->
    <form action="search.php" method="POST" class="search-form">
        <input type="text" name="key" id="search-box" placeholder="search here..">
        <button type="submit" name="search">
            <label for="search-box" class="fas fa-search"></label>
        </button>
    </form>

    <!-- Login Form -->
    <form action="function.php" method="POST" class="login-form">
        <h3>login now</h3>

        <input type="email" name="email" placeholder="your email" class="box">
        <input type="password" name="password" placeholder="your password" class="box">

        <p>forget your password <a href="#">click here</a></p>
        <p>don't have an account <a href="#">create now</a></p>

        <input type="submit" name="login" value="login now" class="button">
    </form>

    <!-- Sign-Up Form -->
    <form action="function.php" method="POST" enctype="multipart/form-data" class="register-form">
        <h3>sign-up now</h3>

        <input type="text" name="full_name" required="" placeholder="your name" class="box">
        <input type="email" name="email" required="" placeholder="your email" class="box">
        <input type="password" name="password" required="" placeholder="your password" class="box">
        <input type="number" name="phone" required="" placeholder="your phone no" class="box">
        <input type="file" name="profile" required="" class="box">

        <p>i have a account <a href="#">login now</a></p>

        <input type="submit" name="register" value="sign-up now" class="button">
    </form>

    <!-- View Your Details -->
    <form action="" method="POST" enctype="multipart/form-data" class="view-btn">
        <h3>view-your details</h3>

        <center>
            <div class="row">
                <div class="col-lg-3"></div>

                <div class="col-lg-6">
                    <img class="img-fluid rounded-circle" src="admin/admin_uploads/<?php echo $_SESSION['UserProfile']; ?>">
                </div>

                <div class="col-lg-3"></div>
            </div>
        </center>

        <input type="text" name="full_name" readonly="" value="<?php echo $_SESSION['UserFullName']; ?>" class="box">
        <input type="email" name="email" readonly="" value="<?php echo $_SESSION['UserEmail']; ?>" class="box">
        <input type="number" name="phone" readonly="" value="<?php echo $_SESSION['UserPhone']; ?>" class="box">

        <!-- User Logout Button -->
        <a href="logout.php" class="button">
            <i class="fa-solid fa-right-from-bracket"></i> logout
        </a>

    </form>
</header>