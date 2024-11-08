<?php
    if (isset($_SESSION['uname'])){
        $uname = $_SESSION['uname'];
    }
?>

<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">

            <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">
                        Menu
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="admin-home-page.php"><i class="fas fa-home"></i>Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-10" aria-controls="submenu-10"><i class="fa fa-bed" aria-hidden="true"></i>                        Rooms</a>
                        <div id="submenu-10" class="collapse submenu" style="">
                            <ul class="nav flex-column">

                                <li class="nav-item">
                                    <a class="nav-link" href="room-details.php">Room Details</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="add-room-details.php">Add Room Details</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-5" aria-controls="submenu-5"><i class="fas fa-fw fa-table"></i>Bookings</a>
                        <div id="submenu-5" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="available-rooms.php">New Booking</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="all-bookings-details.php">All Bookings</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="complete-bookings-details.php">Complete Bookings</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="pending-bookings-details.php">Pending Bookings</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="manage-gallery.php"><i class="far fa-images"></i>Manage Gallery</a>
                    </li>

                    <?php
                        require_once ("config.php");
                        // $uname = $_SESSION['uname'];

                        $sql = "SELECT * FROM users WHERE uname='$uname'";
                        $result = mysqli_query($conn, $sql);
                        $record = mysqli_fetch_assoc($result);

                        if ($record['is_admin'] == 'yes'){
                            echo "
                            <li class='nav-item'>
                                <a class='nav-link' href='create-uaccount.php'><i class='fa fa-user-plus' aria-hidden='true'></i>Create User Account</a>
                            </li>";
                        }
                    ?>

                </ul>
            </div>

        </nav>
    </div>
</div>