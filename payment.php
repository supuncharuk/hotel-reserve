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
            color: inherit; /* Matches the text color */
            padding: 0;
            text-align: right; /* Aligns text to the right */
            width: auto; /* Shrinks input to content size */
            pointer-events: none; /* Makes the input non-clickable */
        }

        .input-as-span:focus {
            outline: none; /* Removes the focus outline */
        }
    </style>

</head>

    <body class="bg-body-tertiary">

    <?php
    require_once ("admin/includes/config.php");

    if (isset($_REQUEST['booking_id'])){
        $booking_id = $_POST['booking_id'];

        $sql = "SELECT * FROM bookings WHERE booking_id = $booking_id";
        $result = mysqli_query($conn, $sql);
        $record = mysqli_fetch_assoc($result);
        $room_num = $record['room_number'];

        $sql2 = "SELECT room_price FROM rooms WHERE room_number=$room_num";
        $result2 = mysqli_query($conn, $sql2);
        $record2 = mysqli_fetch_assoc($result2);

        $room_price = $record2['room_price'];
        $room_price = number_format($room_price, 2, '.', '');

        $vat = $room_price * 18 /100;
        $vat = number_format($vat, 2, '.', '');

        $ssc_levy = $room_price * 2.5 / 100;
        $ssc_levy = number_format($ssc_levy, 2, '.', '');

        $promo = 0;

        $total = $room_price + $vat + $ssc_levy - $promo;
        $total = number_format($total, 2, '.', '');
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST["checkout"])){
        $booking_id = trim(htmlspecialchars($_REQUEST["book_id"]));
        $vat = trim(htmlspecialchars($_REQUEST["vat"]));
        $ssc_levy = trim(htmlspecialchars($_REQUEST["ssc_levy"]));
        $promo = trim(htmlspecialchars($_REQUEST["promo"]));
        $total = trim(htmlspecialchars($_REQUEST["total"]));

        $sql3 = "UPDATE bookings SET paid='1', discount=$promo, vat=$vat, total_payment=$total WHERE booking_id = $booking_id";

        $result3 = mysqli_query($conn, $sql3);

        if ($result3){
            echo "<script>alert('Your Payment is successfull')</script>";
        }else{
            echo "<script>alert('Something Went Wrong')</script>";
        }
    }
?>

        <div class="container py-5">
            <main>

                <div class="text-center pb-4">
                    <img class="d-block mx-auto mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
                    <h2>Booking Payment</h2>
                </div>

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="needs-validation" method="post" novalidate>

                    <input type="hidden" name="book_id" value="<?php echo $booking_id ?>">

                    <div class="row g-5">

                        <div class="col-md-5 col-lg-4 order-md-last">
                            <h4 class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-primary">Payment Description</span>
                            </h4>

                            <ul class="list-group mb-3">
                                <li class="list-group-item d-flex justify-content-between lh-sm">
                                    <div>
                                        <h6 class="my-0">#</h6>
                                    </div>
                                    <div>
                                        <h6>Rs.</h6>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between lh-sm">
                                    <div>
                                        <h6 class="my-0">Room Price</h6>
                                    </div>
                                    <div class="input-as-span-wrapper text-body-secondary">
                                        <input type="number" class="input-as-span text-body-secondary" value="<?php echo $room_price ?>" disabled>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between lh-sm">
                                    <div>
                                        <h6 class="my-0">VAT (18%)</h6>
                                    </div>
                                    <div class="input-as-span-wrapper text-body-secondary">
                                        <input type="number" class="input-as-span text-body-secondary" name="vat" value="<?php echo $vat ?>" readonly>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between lh-sm">
                                    <div>
                                        <h6 class="my-0">SSC Levy</h6>
                                    </div>
                                    <div class="input-as-span-wrapper text-body-secondary">
                                        <input type="number" class="input-as-span text-body-secondary" name="ssc_levy" value="<?php echo $ssc_levy ?>" readonly>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between bg-body-tertiary">
                                    <div class="text-success">
                                        <h6 class="my-0">Promo code</h6>
                                    </div>
                                    <div class="input-as-span-wrapper text-body-secondary">
                                        <input type="number" class="input-as-span text-success" name="promo" value="<?php echo $promo ?>" readonly>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between text-danger">
                                    <div>
                                        <h6 class="my-0">Total Price</h6>
                                    </div>
                                    <div class="input-as-span-wrapper">
                                        <input type="number" class="input-as-span fw-medium" name="total" value="<?php echo $total ?>" readonly>
                                    </div>
                                </li>
                            </ul>

                            <form class="card p-2">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Promo code" disabled>
                                    <button type="submit" class="btn btn-secondary" disabled>Redeem</button>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-7 col-lg-8">
                            
                            <h4 class="mb-3">Payment</h4>

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
                                    <input type="text" class="form-control" id="cc-number" name="cc-number" required>
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
                                    <input type="text" class="form-control" id="cc-cvv" name="cc-cvv" required>
                                    <div class="invalid-feedback">
                                        Security code required
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <input type="submit" class="w-100 btn btn-primary" name="checkout" value="Continue to checkout">

                        </div>

                    </div>

                </form>
            </main>
        </div>

        <?php include_once ("includes/js-links-inc.php") ?>
        <script src="assets/js/validation.js"></script>

    </body>

</html>
