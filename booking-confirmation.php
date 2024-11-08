<?php
    require_once ("admin/includes/config.php");

    if (isset($_REQUEST['booking_ref'])){
        $booking_ref = $_GET['booking_ref'];

        $sql = "SELECT booking_id FROM bookings WHERE booking_ref = '$booking_ref'";
        $result = mysqli_query($conn, $sql);
        $record = mysqli_fetch_assoc($result);
        $booking_id = $record['booking_id'];
    } 
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
                min-height: 100vh;
                margin: 0;
                padding: 0;  
                box-sizing: border-box;            
            }
            section{
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 40px 0;
                background-color:#2466dee3;
            } 
            .main-content {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
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

        <section class="main-content">
            <div class="spl-container">
                <div class="">      
                    <div class="card">
                        <h1 class="card-header text-center fs-4 pt-3 pb-3">Booking Confirmation</h1>

                        <div class="card-body text-center" style="padding:25px 20px;"> 
                            <p class="mb-0">Your booking is confirmed. Please select a payment option:</p>

                            <div class="row mt-4">
                                <div class="col-sm-6 mb-2">
                                    <form action="download-booking-details" method="POST">
                                        <input type="hidden" name="booking_id" value="<?php echo $booking_id; ?>" readonly>
                                        <input type="submit" class="btn btn-warning w-100" value="Pay Later"></button>
                                    </form>
                                </div>

                                <div class="col-sm-6">
                                    <form action="payment.php" method="POST">
                                        <input type="hidden" name="booking_id" value="<?php echo $booking_id; ?>">
                                        <input type="submit" class="btn btn-primary w-100" value="Pay Now"></button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php include_once ("includes/footer2.php") ?>

        <?php include_once ("includes/js-links-inc.php") ?>

    </body>
</html>
