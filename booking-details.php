<?php
  require_once ("admin/includes/config.php");
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Royal Hotel</title>
        
        <?php include_once ("includes/css-links-inc.php") ?>

        <style>
            html,
            body{
                height: 100%;
            }
            section{
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 40px 0;
                background-color:#2466dee3;
            } 
            .spl-container {
                width: 100%;
                max-width: 700px;
                padding: 15px;
                margin: auto;
            }
            input{
                font-size: 14px !important;
            }
        </style>
    </head>
    <body style="background-color:#2466dee3;">

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
               
        <!--================Contact Area =================-->
        <section class="h-100">
            <div class="spl-container">
                <div class="">      
                    <div class="card">
                        <h1 class="card-header text-center fs-4 pt-3 pb-3">Reservation Details</h1>

                        <div class="card-body" style="padding:25px 20px;"> 
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="needs-validation" method="post" novalidate>

                                <?php
                                    if (isset($_REQUEST["room_id"])){
                                        $rid = $_GET["room_id"];
                                    }
                                ?>

                                <div class="form-group row mb-3">
                                    <label for="roomNumber" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-form-label">Room Number</label>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control" id="roomNumber" name="room_number" value="<?php echo isset($rid) ? $rid : '' ?>" readonly required>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="customerName" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-form-label">Name</label>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control" id="rreservemName" name="customer_name" required>
                                        <div class="invalid-feedback">
                                            Enter your name
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="customerEmail" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-form-label">Email</label>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <input type="email" class="form-control" id="reserveEmail" name="customer_email" required>
                                        <div class="invalid-feedback">
                                            Enter your email
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="customerMobile" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-form-label">Mobile Number</label>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <input type="tel" class="form-control" id="reserveMobile" name="customer_mobile" required>
                                        <div class="invalid-feedback">
                                            Enter your mobile number
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="CheckingDate" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-form-label">Checking Date</label>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <input type="date" class="form-control" id="CheckingDate" name="checking_date" required>
                                        <div class="invalid-feedback">
                                            Select your checking date
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="CheckoutDate" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-form-label">Checkout Date</label>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <input type="date" class="form-control" id="CheckoutDate" name="checkout_date" required>
                                        <div class="invalid-feedback">
                                            Select your checkout date
                                        </div>
                                    </div>
                                </div>

                            
                                <!-- <div class="col-md-12 text-right">
                                    <button type="submit" value="submit" class="btn theme_btn button_hover">Send Message</button>
                                </div> -->
                                <div class="form-group pt-2 text-center">
                                    <input type="button" class="btn btn-block btn-primary" value="Book Now" data-bs-toggle="modal" data-bs-target="#verticalyCentered">
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="verticalyCentered" tabindex="-1" aria-labelledby="verticalyCenteredLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="verticalyCenteredLabel">Modal title</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are yo sure to submit your booking details ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                <input type="submit" class="btn btn-primary" name="submit" id="saveButton" value="Yes">
                                            </div>
                                        </div>
                                    </div>
                                </div> 

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================Contact Area =================-->

        <?php include_once ("includes/js-links-inc.php") ?>
        <script src="assets/js/validation.js"></script>
        <script src="assets/js/utils.js"></script>
        <script src="assets/js/alert-toast.js"></script>

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST["submit"])){
                $rnumber = trim(htmlspecialchars($_REQUEST["room_number"]));
                $cname = trim(htmlspecialchars($_REQUEST["customer_name"]));
                $ceamil = trim(htmlspecialchars($_REQUEST["customer_email"]));
                $cmobile = trim(htmlspecialchars($_REQUEST["customer_mobile"]));
                $checking_date = trim(htmlspecialchars($_REQUEST["checking_date"]));
                $checkout_date = trim(htmlspecialchars($_REQUEST["checkout_date"]));

                $booking_ref = uniqid('booking_', true);
    
                if (!empty($rnumber) && !empty($cname) && !empty($ceamil) && !empty($cmobile) && !empty($checking_date) && !empty($checkout_date)){
                    // $sql =  "SELECT booking_id FROM bookings WHERE room_number=$rnumber AND ((checking_date < $checking_date AND checkout_date > $checking_date) OR (checking_date > $checking_date AND checkout_date > $checkout_date) OR (checking_date > $checking_date AND checkout_date < $checkout_date))";                           
                    $sql =  "SELECT booking_id FROM bookings WHERE room_number=$rnumber AND (checking_date < $checkout_date AND checkout_date > $checking_date)";                           
                    $result = mysqli_query($conn,$sql);
    
                    if (mysqli_num_rows($result) > 0){
                        $alert_type = "error";
                        $alert_message = "This room is not available";
                        $redirect_url = "accomodation.php";
                        // echo "<script>alert('This room is not availabe')</script>";
                    }else{
                        $sql2 = "INSERT INTO bookings(room_number,customer_name,customer_email,customer_mobile,checking_date,checkout_date,paid,booking_ref) VALUES($rnumber,'$cname','$ceamil','$cmobile','$checking_date','$checkout_date',0,'$booking_ref')";
                        $result2 = mysqli_query($conn,$sql2);
                        $alert_type = "success";
                        $alert_message = "Booked successfully";
                        $redirect_url = "booking-confirmation.php?booking_ref=" . $booking_ref;  // Redirect to payment page
                        // echo "<script>alert('Booked successfully')</script>";
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