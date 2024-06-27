<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">

        <div class="sb-sidenav-menu">
            <div class="nav">

                <div class="sb-sidenav-menu-heading">Core</div>

                <a class="nav-link" href="dashboard.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <div class="sb-sidenav-menu-heading">Interface</div>

                <a class="nav-link" href="manage_books.php">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-book"></i></div>
                    Books
                </a>

                <a class="nav-link" href="manage_author.php">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                    Authors
                </a>

                <a class="nav-link" href="manage_category.php">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-list"></i></div>
                    Categories
                </a>

                <a class="nav-link" href="manage_users.php">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                    Members
                </a>

                <a class="nav-link" href="manage_fines.php">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-file-invoice"></i></div>
                    Fines
                </a>

                <a class="nav-link" href="manage_lendings.php">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-address-book"></i></div>
                    Lendings
                </a>

            </div>
        </div>

        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            <?php echo $adminResult[0]['full_name']; ?>
        </div>

    </nav>
</div>