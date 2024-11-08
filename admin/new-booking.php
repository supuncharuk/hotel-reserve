<?php
    session_start();

    if (!isset($_SESSION['uname'])){
        header("location: index.php");
    }

    require_once ("includes/config.php");

    if (isset($_REQUEST['rid'])){
        $rid = $_GET['rid'];
        $cindate = $_GET['cindate'];
        $coutdate =  $_GET['coutdate'];
    }
?>

<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>New Booking</title>
    <link rel="icon" href="assets/images/logo/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="assets/libs/css/toast.css">
</head>

<body>

    <div class="toast-container top-50 start-50 translate-middle p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
            <strong class="me-auto">Alert</strong>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button> -->
            </div>
            <div class="toast-body" id="alert_msg">
                <!--Message Here-->
            </div>
        </div>
    </div>
    <div id="toastBackdrop" class="toast-backdrop"></div>
    
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
                            <h2 class="pageheader-title">New Booking</h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Bookings</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">New Booking</li>
                                    </ol>
                                </nav>
                            </div>                                    
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->

                <div class="">
                    <div class="card">

                        <h5 class="card-header">Horizontal Form</h5>
                        <div class="card-body">

                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="needs-validation" id="form" method="post" novalidate>
            
                                <div class="form-group row">
                                    <label for="roomNumber" class="col-lg-2 col-md-3 col-sm-3 col-xs-12 col-form-label">Room Number</label>
                                    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                                        <input type="number" class="form-control" id="roomNumber" name="room_number" value="<?php echo isset($rid) ? $rid : '' ?>" readonly  required>
                                        <div class="invalid-feedback">
                                            Enter Room Number
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="customerName" class="col-lg-2 col-md-3 col-sm-3 col-xs-12 col-form-label">Customer Name</label>
                                    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control" id="customerName" name="customer_name"  required>
                                        <div class="invalid-feedback">
                                            Enter Customer Name
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="customerEmail" class="col-lg-2 col-md-3 col-sm-3 col-xs-12 col-form-label">Customer Email</label>
                                    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control" id="customerEmail" name="customer_email" required>
                                        <div class="invalid-feedback">
                                            Enter Customer Email
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="customerMobile" class="col-lg-2 col-md-3 col-sm-3 col-xs-12 col-form-label">Customer Mobile</label>
                                    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control" id="customerMobile" name="customer_mobile"  required>
                                        <div class="invalid-feedback">
                                            Enter Customer Mobile
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="checkinDate" class="col-lg-2 col-md-3 col-sm-3 col-xs-12 col-form-label">Check-in Date</label>
                                    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                                        <input type="date" class="form-control" id="checkinDate" name="checking_date" value="<?php echo isset($cindate) ? $cindate : '' ?>" readonly required>
                                        <div class="invalid-feedback">
                                            Select Check-in Date
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="checkoutDate" class="col-lg-2 col-md-3 col-sm-3 col-xs-12 col-form-label">Check-out Date</label>
                                    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                                        <input type="date" class="form-control" id="checkoutDate" name="checkout_date" value="<?php echo isset($coutdate) ? $coutdate : '' ?>" readonly required>
                                        <div class="invalid-feedback">
                                            Select Check-out Date
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="paymentWay" class="col-lg-2 col-md-3 col-sm-3 col-xs-12 col-form-label">Payment</label>
                                    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12 col-form-label">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="payment_way" id="inlineRadio1" value="pay now" required>
                                            <label class="form-check-label" for="inlineRadio1">Pay Now</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="payment_way" id="inlineRadio2" value="pay later" required>
                                            <label class="form-check-label" for="inlineRadio2">Pay Later</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row pt-2 pt-sm-5 mt-1">
                                    <div class="col-sm-6">
                                        <p class="text-center">
                                            <!-- <input type="submit" class="btn btn-space btn-primary" name="book" value="Book"> -->
                                            <input type="button" class="btn btn-space btn-primary" value="Book Now" data-toggle="modal" data-target="#verticalyCentered">
                                            <input type="reset" class="btn btn-space btn-secondary">
                                        </p>
                                    </div>
                                </div>

                                 <!-- Modal -->
                                 <div class="modal fade" id="verticalyCentered" tabindex="-1" role="dialog" aria-labelledby="verticalyCenteredLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="verticalyCenteredLabel">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure to submit booking details?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                <input type="submit" class="btn btn-primary" name="book" id="saveButton" value="Yes">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal -->

                            </form>
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
    <script src="assets/libs/js/utils.js"></script>
    <script src="assets/libs/js/alert-toast.js"></script>


    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST["book"])){
            $rnumber = trim(htmlspecialchars($_REQUEST["room_number"]));
            $cname = trim(htmlspecialchars($_REQUEST["customer_name"]));
            $ceamil = trim(htmlspecialchars($_REQUEST["customer_email"]));
            $cmobile = trim(htmlspecialchars($_REQUEST["customer_mobile"]));
            $checking_date = trim(htmlspecialchars($_REQUEST["checking_date"]));
            $checkout_date = trim(htmlspecialchars($_REQUEST["checkout_date"]));
            $payment_way  = trim(htmlspecialchars($_REQUEST["payment_way"]));

            $booking_ref = uniqid('booking_', true);

            if (!empty($rnumber) && !empty($cname) && !empty($ceamil) && !empty($cmobile) && !empty($checking_date) && !empty($checkout_date)){
                // $sql =  "SELECT booking_id FROM bookings WHERE room_number=$rnumber AND ((checking_date < $checking_date AND checkout_date > $checking_date) OR (checking_date > $checking_date AND checkout_date > $checkout_date) OR (checking_date > $checking_date AND checkout_date < $checkout_date))";                           
                $sql = "SELECT r.room_number
                        FROM rooms AS r
                        WHERE r.room_number IN (
                            SELECT b.room_number
                            FROM bookings AS b
                            WHERE b.room_number = $rnumber AND (b.checking_date < '$checkout_date' AND b.checkout_date > '$checking_date')
                        )";                     
                $result = mysqli_query($conn,$sql);

                if (mysqli_num_rows($result) > 0){
                    $alert_type = "error";
                    $alert_message = "This room is not available";
                    $redirect_url = "available-rooms.php";
                    // echo "<script>alert('This room is not availabe')</script>";
                }else{
                    $sql2 = "INSERT INTO bookings(room_number,customer_name,customer_email,customer_mobile,checking_date,checkout_date,paid,booking_ref) VALUES($rnumber,'$cname','$ceamil','$cmobile','$checking_date','$checkout_date',0,'$booking_ref')";
                    $result2 = mysqli_query($conn,$sql2);
                    $alert_type = "success";
                    $alert_message = "Booked successfully";

                    if ($result2 && $payment_way == "pay now"){
                        $redirect_url = "../payment.php?booking_ref=" . $booking_ref;
                    }else{
                        $redirect_url = "../booking-confirmation.php?booking_ref=" . $booking_ref;
                    }
                }
            }else{
                $alert_type = "error";
                $alert_message = "All fields required";
                $redirect_url = "";  // No redirect for errors
                // echo "<script>alert('All fields required')</script>";
            }

            // Pass variables to JavaScript
                echo "<script>
                var alertType = '$alert_type';
                var alertMessage = '$alert_message';
                var redirectUrl = '$redirect_url';
            </script>";
        } 
    ?>

</body>
 
</html>