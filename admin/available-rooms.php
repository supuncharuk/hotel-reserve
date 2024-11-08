<?php
    session_start();

    if (!isset($_SESSION['uname'])){
        header("location: index.php");
    }
    
    require_once ("includes/config.php");
?>

<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Available Rooms</title>
    <link rel="icon" href="assets/images/logo/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/buttons.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/select.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/fixedHeader.bootstrap4.css">

    <style>
        table th,tr{
            text-align: center;
        }
    </style>
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
                            <h2 class="pageheader-title">Available Rooms</h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="admin-home-page" class="breadcrumb-link">Home</a></li>
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
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">

                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="needs-validation pb-5" id="form" method="post" novalidate>
                                    
                                    <?php
                                        $today = date("Y-m-d");
                                        $tomorrow = date("Y-m-d", strtotime("+1 day"));
                                    ?>

                                    <div class="form-group row">
                                        <div class="col-md-6 pb-3">
                                            <label for="CheckingDate" class="col-sm-3 col-xs-12 col-form-label">Check-in Date</label>
                                            <div class="col-sm-9 col-xs-12">
                                                <input type="date" class="form-control" id="CheckingDate" name="checking_date"  min="<?php echo $today; ?>" required>
                                                <div class="invalid-feedback">
                                                    Select your checkin date
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 pb-3">
                                            <label for="CheckoutDate" class="col-sm-3 col-xs-12 col-form-label">Check-out Date</label>
                                            <div class="col-sm-9 col-xs-12">
                                                <input type="date" class="form-control" id="CheckoutDate" name="checkout_date" min="<?php echo $tomorrow; ?>" required>
                                                <div class="invalid-feedback">
                                                    Select your checkout date
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <input type="submit" class="btn btn-primary" name="check_avialability" value="Check Available Rooms">
                                    </div>

                                </form>

                                <?php
                                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST["check_avialability"])){
                                        $checking_date = trim(htmlspecialchars($_REQUEST["checking_date"]));
                                        $checkout_date = trim(htmlspecialchars($_REQUEST["checkout_date"]));
                                    
                                        if (!empty($checking_date) && !empty($checkout_date)){
                                            $sql = "SELECT r.room_number,r.room_name,r.room_image_name,r.room_type,r.no_persons,r.ac_availability,r.room_price
                                                FROM rooms AS r
                                                WHERE r.room_number NOT IN (
                                                    SELECT b.room_number
                                                    FROM bookings AS b
                                                    WHERE b.room_number = r.room_number AND (b.checking_date < '$checkout_date' AND b.checkout_date > '$checking_date')
                                                )";
                                            $result = mysqli_query($conn, $sql);
                                            // $row = mysqli_fetch_row($result);
                                            // var_dump($row);

                                            echo "<h4>Available rooms from " .$checking_date. " to " .$checkout_date. "</h4>";

                                            echo 
                                            "<div class='table-responsive'>
                                                <table id='example' class='table table-striped table-bordered second' style='width:100%'>
                                                    <thead>
                                                        <tr>
                                                            <th>Room Number</th>
                                                            <th>Room Name</th>
                                                            <th>Room Type</th>
                                                            <th>AC Availability</th>
                                                            <th>Number of Persons</th>
                                                            <th>Room Image</th>
                                                            <th>Room Price</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>";

                                                    if (mysqli_num_rows($result)>0){
                                                        while($row = mysqli_fetch_row($result)){
                                                            // var_dump($row);

                                                            $rid = urlencode($row[0]);
                                                            $cindate = urlencode($checking_date);
                                                            $coutdate = urlencode($checkout_date);

                                                            echo 
                                                            "<tr>
                                                                <td>$row[0]</td>
                                                                <td>$row[1]</td>
                                                                <td>$row[3]</td>
                                                                <td>$row[5]</td>
                                                                <td>$row[4]</td>
                                                                <td>
                                                                    <img src='assets/images/rooms/$row[2]' style='width:50px; height:50px; cursor:pointer;' data-toggle='modal' data-target='#imageModal$row[0]'>
                                                                </td>
                                                                <td>$row[6]</td>
                                                                <td>
                                                                    <a href='new-booking.php?rid=$rid&cindate=$cindate&coutdate=$coutdate' class='btn btn-warning btn-sm mr-2'>
                                                                        Book &nbsp; <i class='fas fa-plus'></i>
                                                                    </a>
                                                                </td>
                                                            </tr>

                                                            <div class='modal fade pr-0' id='imageModal$row[0]' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                                                <div class='modal-dialog modal-dialog-centered' role='document'>
                                                                    <div class='modal-content'>
                                                                        <div class='modal-header'>
                                                                            <h5 class='modal-title' id='exampleModalLabel'>$row[1]</h5>
                                                                            <a href='#' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></a>
                                                                        </div>
                                                                        <div class='modal-body'>
                                                                            <img src='assets/images/rooms/$row[2]' style='width:100%;'>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>";
                                                        }          
                                                    }

                                                    echo "</tbody>";
                                                echo "</table>";
                                            echo "</div>";
                                        }
                                    }
                                ?>

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
    <script src="assets/libs/js/validation.js"></script>

    <script src="assets/libs/js/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/libs/js/dataTables.buttons.min.js"></script>
    <script src="assets/vendor/datatables/js/buttons.bootstrap4.min.js"></script>
    <script src="assets/vendor/datatables/js/data-table.js"></script>
    <script src="assets/libs/js/jszip.min.js"></script>
    <script src="assets/libs/js/pdfmake.min.js"></script>
    <script src="assets/libs/js/vfs_fonts.js"></script>
    <script src="assets/libs/js/buttons.html5.min.js"></script>
    <script src="assets/libs/js/buttons.print.min.js"></script>
    <script src="assets/libs/js/buttons.colVis.min.js"></script>
    <script src="assets/libs/js/dataTables.rowGroup.min.js"></script>
    <script src="assets/libs/js/dataTables.select.min.js"></script>
    <script src="assets/libs/js/dataTables.fixedHeader.min.js"></script>

    <script>
        function del(id){
            if (confirm("Do you want to delete this room details") == false){
                return false;
            }

            $.ajax({
                url: 'includes/room-del-action.php',
                type: 'POST',
                data: {id:id},
                success: function(){
                    alert("Successfully deleted");
                    window.location.reload();
                }
            });
        }
    </script>
</body>
 
</html>