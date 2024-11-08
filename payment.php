<?php
    require_once ("admin/includes/config.php");

    if (isset($_REQUEST['booking_id']) || isset($_REQUEST['booking_ref'])){
        if (isset($_REQUEST['booking_id'])){
            $booking_id = $_POST['booking_id'];

            $sql = "SELECT * FROM bookings WHERE booking_id = $booking_id";
            $result = mysqli_query($conn, $sql);
            $record = mysqli_fetch_assoc($result);
            $room_num = $record['room_number'];

        }else if (isset($_REQUEST['booking_ref'])){
            $booking_ref = $_GET['booking_ref'];

            $sql = "SELECT * FROM bookings WHERE booking_ref = '$booking_ref'";
            $result = mysqli_query($conn, $sql);
            $record = mysqli_fetch_assoc($result);
            $room_num = $record['room_number'];
            $booking_id = $record['booking_id'];
        }

        $checkin_date = strtotime($record['checking_date']);
        $checkout_date= strtotime($record['checkout_date']);

        $diffInSeconds =  $checkout_date - $checkin_date;
        $diffInDays = $diffInSeconds / (60 * 60 * 24); // Convert seconds to days
        $ndays = $diffInDays;

        $sql2 = "SELECT room_price FROM rooms WHERE room_number=$room_num";
        $result2 = mysqli_query($conn, $sql2);
        $record2 = mysqli_fetch_assoc($result2);

        $room_price = $record2['room_price'] * $ndays;
        $room_price = number_format($room_price, 2, '.', '');

        $vat = $room_price * 18 /100;
        $vat = number_format($vat, 2, '.', '');

        $ssc_levy = $room_price * 2.5 / 100;
        $ssc_levy = number_format($ssc_levy, 2, '.', '');

        $promo = 0;

        $total = $room_price + $vat + $ssc_levy - $promo;
        $total = number_format($total, 2, '.', '');
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>Payment</title>

    <?php include_once ("includes/css-links-inc.php") ?>

    <style>
        .input-as-span {
            border: none;
            background: transparent;
            color: inherit;
            padding: 0;
            text-align: right;
            width: auto;
            pointer-events: none;
        }

        .input-as-span:focus {
            outline: none;
        }

        input{
            font-size: 14px !important;
        }
    </style>

</head>

    <body class="bg-body-tertiary">

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

        <div class="container py-5">
            <main>

                <div class="text-center pb-4">
                    <img class="d-block mx-auto mb-5" src="assets/image/Logo.png" alt="">
                    <h2>Booking Payment</h2>
                </div>

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="needs-validation" method="post" novalidate>

                    <input type="hidden" name="book_id" value="<?php echo isset($booking_id) ? $booking_id : '' ?>">

                    <div class="row g-5">

                        <div class="col-md-5 col-lg-4 order-md-last">
                            <h4 class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-primary">Payment Description</span>
                            </h4>

                            <table class="table">
                                <tr>
                                    <td align="center" colspan="2">Prices are on Sri Lankan Rupees (Rs.)</td>
                                </tr>
                                <tr>
                                    <?php
                                        if (isset($ndays)){
                                            if ($ndays == 1){
                                                $days = '1 Day';
                                            }else{
                                                $days = $ndays. ' Days'; 
                                            }
                                        }else{
                                            $days ='0 Days';
                                        }
                                    ?>
                                    <th scope="row"><h6 class="my-0">Room Price (<?php echo $days ?>)</h6></th>
                                    <td align="right"><input type="number" class="input-as-span text-body-secondary" value="<?php echo isset($room_price) ? $room_price : '' ?>" disabled></td>
                                </tr>
                                <tr>
                                    <th scope="row"><h6 class="my-0">VAT (18%)</h6></th>
                                    <td align="right"><input type="number" class="input-as-span text-body-secondary" name="vat" value="<?php echo isset($vat) ? $vat : '' ?>" readonly></td>
                                </tr>
                                <tr>
                                    <th scope="row"><h6 class="my-0">SSC Levy</h6></th>
                                    <td align="right"><input type="number" class="input-as-span text-body-secondary" name="ssc_levy" value="<?php echo isset($ssc_levy) ? $ssc_levy : '' ?>" readonly></td>
                                </tr>
                                <tr>
                                    <th scope="row"><h6 class="my-0 text-success">Discount</h6></th>
                                    <td align="right"><input type="number" class="input-as-span text-success" name="promo" value="<?php echo isset($promo) ? $promo : '' ?>" readonly></td>
                                </tr>
                                <tr>
                                    <th scope="row"><h6 class="my-0 text-danger">Total Price (Rs.)</h6></th>
                                    <td align="right"><input type="number" class="input-as-span text-danger fw-medium" name="total" value="<?php echo isset($total) ? $total : '' ?>" readonly></td>
                                </tr>
                            </table>

                            <form class="card p-2">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Promo code" disabled>
                                    <button type="submit" class="btn btn-secondary" disabled>Redeem</button>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-7 col-lg-8">
                            
                            <h4 class="mb-3 text-primary">Payment</h4>

                            <div class="my-3">
                                <div class="form-check">
                                    <input id="credit" name="paymentMethod" type="radio" class="form-check-input" required>
                                    <label class="form-check-label" for="credit">Credit card</label>
                                </div>
                                <div class="form-check">
                                    <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required>
                                    <label class="form-check-label" for="debit">Debit card</label>
                                </div>
                            </div>

                            <div class="row gy-3">
                                <div class="col-md-6">
                                    <label for="cc-name" class="form-label">Name on card</label>
                                    <input type="text" class="form-control" id="cc-name" name="cc-name" required>
                                    <small class="text-body-secondary">Full name as displayed on card</small>
                                    <div class="invalid-feedback">
                                        Name on card is required
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="cc-number" class="form-label">Credit card number</label>
                                    <input type="number" class="form-control" id="cc-number" name="cc-number" required>
                                    <div class="invalid-feedback">
                                        Credit card number is required
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="cc-expiration" class="form-label">Expiration</label>
                                    <input type="text" class="form-control" id="cc-expiration" name="cc-expiration" required>
                                    <div class="invalid-feedback">
                                        Expiration date required
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="cc-cvv" class="form-label">CVV</label>
                                    <input type="number" class="form-control" id="cc-cvv" name="cc-cvv" required>
                                    <div class="invalid-feedback">
                                        Security code required
                                    </div>
                                </div>
                            </div>

                            <!-- <input type="hidden" name="from_admin" value="<?php echo isset($from_admin) ? $from_admin : '' ?>"> -->

                            <hr class="my-4">

                            <input type="submit" class="w-100 btn btn-primary" name="pay" value="Continue to Pay">

                        </div>

                    </div>

                </form>
            </main>
        </div>

        <?php include_once ("includes/footer2.php") ?>

        <?php include_once ("includes/js-links-inc.php") ?>
        <script src="assets/js/validation.js"></script>
        <script src="assets/js/alert-toast.js"></script>

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST["pay"])){
                $booking_id = trim(htmlspecialchars($_REQUEST["book_id"]));
                $vat = trim(htmlspecialchars($_REQUEST["vat"]));
                $ssc_levy = trim(htmlspecialchars($_REQUEST["ssc_levy"]));
                $promo = trim(htmlspecialchars($_REQUEST["promo"]));
                $total = trim(htmlspecialchars($_REQUEST["total"]));
                // $redirect_admin = trim(htmlspecialchars($_REQUEST["from_admin"]));
    
                $sql3 = "UPDATE bookings SET paid='1', vat=$vat, ssc_levy=$ssc_levy, discount=$promo, total_payment=$total WHERE booking_id = $booking_id";
    
                $result3 = mysqli_query($conn, $sql3);
    
                if ($result3){
                    // echo "<script>alert('Your Payment is successfull')</script>";
                    $alert_type = "success";
                    $alert_message = "Your Payment is successfull";

                    // if (!empty($redirect_admin)){
                    //     $redirect_url = $redirect_admin;
                    // }else{
                        $redirect_url = "download-payment-reciept.php?id=$booking_id";
                    // }
                }else{
                    // echo "<script>alert('Something Went Wrong')</script>";
                    $alert_type = "error";
                    $alert_message = "Your Payment is not successfull";
                    $redirect_url = "";
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
