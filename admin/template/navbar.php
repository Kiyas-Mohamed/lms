<?php
include_once '../db_config.php';
$id = $_SESSION['AdminId'];

try {

    $stmt = $conn->prepare("SELECT * FROM users");
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    if ($result[0]['status'] == '1') {

        $status = '<option value="1" selected>Active</option>
                <option value="0">Deactive</option>';
    } else {

        $status = '<option value="1">Active</option>
                <option value="0" selected>Deactive</option>';
    }

    if ($result[0]['status'] == '1') {

        $status = 'Active';
    } else {

        $status = 'Deactive';
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE id = $id");
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $adminResult = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error:" . $e->getMessage();
}

$conn = null;

?>

<style>
    .modal-body form input {
        border: none;
        outline: none;
        background: none;
    }

    .modal-body form img {
        width: 150px;
        border: 3px solid #ff7800;
        box-shadow: 0 .5rem 1.5rem rgba(0, 0, 0, .3);
    }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
<nav class="sb-topnav navbar navbar-dark bg-dark navbar-expand">
    <!-- Navbar Brand-->
    <a style="font-size: 18px;" class="navbar-brand ps-3" href="dashboard.php"><?php echo $adminResult[0]['full_name']; ?></a>

    <!-- Sidebar Toggle-->
    <button class="btn btn-link order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#">
        <i class="fa-solid fa-bars-staggered"></i>
    </button>

    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" role="search">
        <div class="input-group d-grid gap-2 d-md-flex">
            <input class="form-control me-2 text-center" type="search" placeholder="Search" aria-label="Search" aria-describedby="btnNavbarSearch">
            <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </form>

    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">

            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="p-1 img-fluid rounded-circle" style="width: 47px;" src="admin_uploads/<?php echo $adminResult[0]['profile']; ?>">
            </a>

            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <!-- Admin Logout Button -->
                <li>
                    <a class="dropdown-item" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                </li>

                <!-- View Details User Button -->
                <button style="background: none; border: none; outline: none;" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <span class="ps-2">
                        <i class="fa-solid fa-address-card"></i> Profile
                    </span>
                </button>
            </ul>

        </li>
    </ul>
</nav>

<!-- Add Form -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-eye"></i> View-Your Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal -->
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="id" value="<?php echo $adminResult[0]['id']; ?>">

                    <div class="row pb-3">
                        <div class="col-lg-12">
                            <center>
                                <img class="img-fluid rounded-circle" src="admin_uploads/<?php echo $adminResult[0]['profile']; ?>">
                            </center>
                            <center>
                                <span class="badge rounded-pill text-bg-success mt-3"><?php echo $status; ?></span>
                            </center>
                        </div>
                    </div>

                    <center>
                        <div class="col-lg-8">
                            <div class="form-outline mb-3">
                                <label class="form-label float-start" for="form6Example1">Full Name<span class="text-success">*</span></label>
                                <input type="text" name="full_name" value="<?php echo $adminResult[0]['full_name']; ?>" readonly="" required="require" id="form6Example1" class="form-control" />
                            </div>

                            <div class="form-outline mb-3">
                                <label class="form-label float-start" for="form6Example1">Email<span class="text-success">*</span></label>
                                <input type="email" name="email" value="<?php echo $adminResult[0]['email']; ?>" readonly="" required="require" id="form6Example1" class="form-control" />
                            </div>

                            <div class="form-outline mb-3">
                                <label class="form-label float-start" for="form6Example1">Phone Number<span class="text-success">*</span></label>
                                <input type="number" name="phone" value="<?php echo $adminResult[0]['phone']; ?>" readonly="" required="require" id="form6Example1" class="form-control" />
                            </div>
                        </div>
                    </center>

                </form>
            </div>

        </div>
    </div>
</div>