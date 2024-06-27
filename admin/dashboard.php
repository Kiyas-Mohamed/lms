<?php
session_start();
include_once '../db_config.php';

if (!isset($_SESSION['AdminId'])) {

    header("Location: index.php");
}
?>

<!-- Header Start -->
<?php include_once '../admin/template/header.php'; ?>
<!-- End Header -->

<body class="sb-nav-fixed">

    <!-- Navbar Start -->
    <?php include_once '../admin/template/navbar.php'; ?>
    <!-- End Navbar -->

    <div id="layoutSidenav">

        <!-- Sidebar Start -->
        <?php include_once '../admin/template/sidebar.php'; ?>
        <!-- End Sidebar -->

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">

                    <h1 class="mt-4" style="color: #ff7800;"><i class="fa-solid fa-book"></i> Online Library</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Admin Panel</li>
                    </ol>

                    <div class="row">

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white border border-5 h6 mb-3">
                                <div class="card-body"><i class="fa-solid fa-book"></i> Total Books</div>
                                <div class="p-4"></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="../admin/manage_books.php">View Books</a>
                                    <div class="text-white"><i class="fa-sharp fa-solid fa-eye"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-dark text-white border border-5 h6 mb-3">
                                <div class="card-body"><i class="fa-solid fa-user"></i> Total Authors</div>
                                <div class="p-4"></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="../admin/manage_author.php">View Authors</a>
                                    <div class="text-white"><i class="fa-sharp fa-solid fa-eye"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-info text-white border border-5 h6 mb-3">
                                <div class="card-body"><i class="fa-solid fa-list"></i> Total Categorise</div>
                                <div class="p-4"></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="../admin/manage_category.php">View Categorise</a>
                                    <div class="text-white"><i class="fa-sharp fa-solid fa-eye"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white border border-5 h6 mb-3">
                                <div class="card-body"><i class="fa-solid fa-users"></i> Total Members</div>
                                <div class="p-4"></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="../admin/manage_users.php">View Members</a>
                                    <div class="text-white"><i class="fa-sharp fa-solid fa-eye"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white border border-5 h6 mb-3">
                                <div class="card-body"><i class="fa-solid fa-file-invoice"></i> Total Fines</div>
                                <div class="p-4"></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="../admin/manage_fines.php">View Fines</a>
                                    <div class="text-white"><i class="fa-sharp fa-solid fa-eye"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-secondary text-white border border-5 h6 mb-3">
                                <div class="card-body"><i class="fa-solid fa-address-book"></i> Total Lendings</div>
                                <div class="p-4"></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="../admin/manage_lendings.php">View Lendings</a>
                                    <div class="text-white"><i class="fa-sharp fa-solid fa-eye"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            <!-- Footer Start -->
            <?php include_once '../admin/template/footer.php'; ?>
            <!-- End Footer -->

            <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>

            <script src="assets/js/datatables-simple-demo.js"></script>

</body>

</html>