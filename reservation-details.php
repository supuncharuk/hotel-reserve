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

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST["submit"])){
                $rnumber = trim(htmlspecialchars($_REQUEST["room_number"]));
                $cname = trim(htmlspecialchars($_REQUEST["customer_name"]));
                $ceamil = trim(htmlspecialchars($_REQUEST["customer_email"]));
                $cmobile = trim(htmlspecialchars($_REQUEST["customer_mobile"]));
                $checking_date = trim(htmlspecialchars($_REQUEST["checking_date"]));
                $checkout_date = trim(htmlspecialchars($_REQUEST["checkout_date"]));
    
                if (!empty($rnumber) && !empty($cname) && !empty($ceamil) && !empty($cmobile) && !empty($checking_date) && !empty($checkout_date)){
                    $sql =  "SELECT booking_id FROM bookings WHERE room_number=$rnumber AND (checking_date<='$checking_date' AND checkout_date>='$checkout_date')";                           
                    $result = mysqli_query($conn,$sql);
    
                    if (mysqli_num_rows($result) > 0){
                        echo "<script>alert('This room is not availabe')</script>";
                    }else{
                        $sql2 = "INSERT INTO bookings(room_number,customer_name,customer_email,customer_mobile,checking_date,checkout_date,paid) VALUES($rnumber,'$cname','$ceamil','$cmobile','$checking_date','$checkout_date',0)";
                        $result2 = mysqli_query($conn,$sql2);
                        echo "<script>alert('Booked successfully')</script>";
                    }
                }else{
                    echo "<script>alert('All fields required')</script>";
                }
            } 
        ?>
               
        <!--================Contact Area =================-->
        <section class="h-100">
            <div class="spl-container">
                <div class="">      
                    <div class="card">
                        <h1 class="card-header text-center fs-4 pt-3 pb-3">Reservation Details</h1>

                        <div class="card-body" style="padding:25px 20px;"> 
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="needs-validation" method="post" novalidate>

                                <div class="form-group row mb-3">
                                    <label for="roomNumber" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-form-label">Room Number</label>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control" id="roomNumber" name="room_number" value="1" readonly required>
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
                                    <input type="submit" class="btn btn-block btn-primary" name="submit" value="Book">
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================Contact Area =================-->

                               
        <script src="admin/assets/libs/js/validation.js"></script>
        
    </body>
</html>