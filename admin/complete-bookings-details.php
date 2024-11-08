<?php
  require_once ("includes/config.php");
?>

<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Complete Bookings Details</title>
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
                            <h2 class="pageheader-title">Complete Bookings Details</h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Bookings</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Complete Bookings</li>
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
                            <!-- <div class="card-header">
                                <h5 class="mb-0">Data Tables - Print, Excel, CSV, PDF Buttons</h5>
                                <p>This example shows DataTables and the Buttons extension being used with the Bootstrap 4 framework providing the styling.</p>
                            </div> -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered second" style="width:100%">

                                        <thead>
                                            <tr>
                                                <th>Booking ID</th>
                                                <th>Room Number</th>
                                                <th>Customer Name</th>
                                                <th>Customer Email</th>
                                                <th>Customer Mobile</th>
                                                <th>Checkin Date</th>
                                                <th>Checkout Date</th>
                                                <th>No. of Days</th>
                                                <th>VAT (Rs.)</th>
                                                <th>SSC Levy (Rs.)</th>
                                                <th>Discount (Rs.)</th>
                                                <th>Total Price (Rs.)</th>
                                            </tr>
                                        </thead>

                                        <tbody>                                          
                                            <?php
                                                $sql = "SELECT * FROM bookings WHERE paid=1 ORDER BY booking_id";
                                                $result = mysqli_query($conn,$sql);

                                                if (mysqli_num_rows($result)>0){
                                                    while($row = mysqli_fetch_assoc($result)){

                                                        $checkin_date = strtotime($row['checking_date']);
                                                        $checkout_date= strtotime($row['checkout_date']);

                                                        $diffInSeconds =  $checkout_date - $checkin_date;
                                                        $diffInDays = $diffInSeconds / (60 * 60 * 24); // Convert seconds to days
                                                        $ndays = $diffInDays;
                                            ?>
                                            <tr>
                                                <td><?php echo $row['booking_id'] ?></td>
                                                <td><?php echo $row['room_number'] ?></td>
                                                <td><?php echo $row['customer_name'] ?></td>
                                                <td><?php echo $row['customer_email'] ?></td>
                                                <td><?php echo $row['customer_mobile'] ?></td>
                                                <td><?php echo $row['checking_date'] ?></td>
                                                <td><?php echo $row['checkout_date'] ?></td>
                                                <td><?php echo $ndays ?></td>
                                                <td><?php echo $row['vat'] ?></td>
                                                <td><?php echo $row['ssc_levy'] ?></td>
                                                <td><?php echo $row['discount'] ?></td>
                                                <td><?php echo $row['total_payment'] ?></td>
                                            </tr>

                                            <?php  
                                                    }
                                                } 
                                            ?>                                           
                                        </tbody>                                                                                                                       

                                    </table>                                                       
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