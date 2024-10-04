<?php
  require_once ("includes/config.php");
?>

<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Room Details</title>
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
                            <h2 class="pageheader-title">Blank Pageheader </h2>
                            <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Rooms</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Room Details</li>
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
                            <div class="card-header">
                                <h5 class="mb-0">Data Tables - Print, Excel, CSV, PDF Buttons</h5>
                                <p>This example shows DataTables and the Buttons extension being used with the Bootstrap 4 framework providing the styling.</p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered second" style="width:100%">

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

                                        <tbody>                                          
                                            <?php
                                                $sql = "SELECT * FROM rooms ORDER BY updated_at DESC";
                                                $result = mysqli_query($conn,$sql);

                                                if (mysqli_num_rows($result)>0){
                                                    while($row = mysqli_fetch_row($result)){
                                            ?>
                                            <tr>
                                                <td><?php echo $row[0] ?></td>
                                                <td><?php echo $row[1] ?></td>
                                                <td><?php echo $row[3] ?></td>
                                                <td><?php echo $row[5] ?></td>
                                                <td><?php echo $row[4] ?></td>
                                                <td>
                                                    <img src="<?php echo $row[2] ?>" style="width:50px; height:50px; cursor:pointer;" data-toggle="modal" data-target="#imageModal<?php echo $row[0]; ?>">
                                                </td>
                                                <td><?php echo $row[6] ?></td>
                                                <td><i class="fas fa-edit text-danger" style="font-size:16px;"></i></td>
                                            </tr>
                                            
                                            <!-- Modal for view room image -->
                                            <div class="modal fade pr-0" id="imageModal<?php echo $row[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"><?php echo $row[1] ?></h5>
                                                            <a href="#" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
                                                        </div>
                                                        <div class="modal-body">
                                                            <img src="<?php echo $row[2] ?>" style="width:100%;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

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
</body>
 
</html>