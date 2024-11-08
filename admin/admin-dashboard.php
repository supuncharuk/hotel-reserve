<?php
    session_start();

    if (!isset($_SESSION['uname'])){
        header("location: index.php");
    }
?>

<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Blank Page With Header</title>
    <link rel="icon" href="assets/images/logo/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <?php include_once ("includes/header.php") ?>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <?php include_once ("includes/sidebar.php") ?>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Dashboard</h2>
                            <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <!-- <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Blank Pageheader</li> -->
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->

                <div class="row">
                    <?php
                        require_once ("includes/header.php");

                        $sql = "SELECT COUNT(room_number) AS no_of_rooms FROM rooms";
                        $result = mysqli_query($conn, $sql);
                        $record = mysqli_fetch_assoc($result);
                    
                    ?>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-muted">Total Rooms</h5>
                                <div class="d-inline-block">
                                    <h1 class="mb-1"><?php echo $record['no_of_rooms']; ?></h1>
                                </div>
                                <div class="d-inline-block float-right font-weight-bold">
                                    <a href="room-details.php" class="text-success"><i class="fas fa-sign-in-alt" style="font-size:25px;"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                        $sql2 = "SELECT COUNT(booking_id) AS no_of_bookings FROM bookings";
                        $result2 = mysqli_query($conn, $sql2);
                        $record2 = mysqli_fetch_assoc($result2);
                    ?>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-muted">All Bookings</h5>
                                <div class="d-inline-block">
                                    <h1 class="mb-1"><?php echo $record2['no_of_bookings']; ?></h1>
                                </div>
                                <div class="d-inline-block float-right font-weight-bold">
                                    <a href="all-bookings-details.php" class="text-success"><i class="fas fa-sign-in-alt" style="font-size:25px;"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                        $sql3 = "SELECT COUNT(booking_id) AS no_of_bookings FROM bookings WHERE paid=1";
                        $result3 = mysqli_query($conn, $sql3);
                        $record3 = mysqli_fetch_assoc($result3);
                    ?>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-muted">Complete Bookings</h5>
                                <div class="d-inline-block">
                                    <h1 class="mb-1"><?php echo $record3['no_of_bookings']; ?></h1>
                                </div>
                                <div class="d-inline-block float-right font-weight-bold">
                                    <a href="complete-bookings-details.php" class="text-success"><i class="fas fa-sign-in-alt" style="font-size:25px;"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                        $sql4 = "SELECT COUNT(booking_id) AS no_of_bookings FROM bookings WHERE paid!=1";
                        $result4 = mysqli_query($conn, $sql4);
                        $record4 = mysqli_fetch_assoc($result4);
                    ?>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-muted">Pending Bookings</h5>
                                <div class="d-inline-block">
                                    <h1 class="mb-1"><?php echo $record4['no_of_bookings']; ?></h1>
                                </div>
                                <div class="d-inline-block float-right font-weight-bold">
                                    <a href="pending-bookings-details.php" class="text-success"><i class="fas fa-sign-in-alt" style="font-size:25px;"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <?php
                        $sql5 = "SELECT SUM(total_payment) AS thisd_income FROM bookings WHERE paid=1 AND (DATE(updated_at) = CURDATE())";
                        $result5 = mysqli_query($conn, $sql5);
                        $record5 = mysqli_fetch_assoc($result5);
                    ?>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-muted">Today's Income</h5>
                                <div class="d-inline-block">
                                    <h1 class="mb-1">Rs. <?php echo number_format($record5['thisd_income'],2); ?></h1>
                                </div>
                                
                            </div>
                        </div>
                    </div>


                    <?php
                        $sql6 = "SELECT SUM(total_payment) AS thism_income FROM bookings WHERE paid=1 AND (YEAR(updated_at) = YEAR(CURDATE()) AND MONTH(updated_at) = MONTH(CURDATE()))";
                        $result6 = mysqli_query($conn, $sql6);
                        $record6 = mysqli_fetch_assoc($result6);
                    ?>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-muted">This Month Income</h5>
                                <div class="d-inline-block">
                                    <h1 class="mb-1">Rs. <?php echo number_format($record6['thism_income'],2); ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>


                    <?php
                        $sql7 = "SELECT SUM(total_payment) AS thisy_income FROM bookings WHERE paid=1 AND (YEAR(updated_at) = YEAR(CURDATE()))";
                        $result7 = mysqli_query($conn, $sql7);
                        $record7 = mysqli_fetch_assoc($result7);
                    ?>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-muted">This Year Income</h5>
                                <div class="d-inline-block">
                                    <h1 class="mb-1">Rs. <?php echo number_format($record7['thisy_income'],2); ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                        $sql8 = "SELECT SUM(total_payment) AS total_income FROM bookings WHERE paid=1";
                        $result8 = mysqli_query($conn, $sql8);
                        $record8 = mysqli_fetch_assoc($result8);
                    ?>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-muted">Total Income</h5>
                                <div class="d-inline-block">
                                    <h1 class="mb-1">Rs. <?php echo number_format($record8['total_income'],2); ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                
            </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php include_once ("includes/footer.php") ?>
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- end main wrapper -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <script src="assets/libs/js/main-js.js"></script>
</body>
 
</html>