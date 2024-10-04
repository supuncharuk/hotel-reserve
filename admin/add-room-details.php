<?php
  require_once ("includes/config.php");
?>

<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Room Deatils</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
</head>

<body>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST["submit"])){
            $room_number = trim(htmlspecialchars($_REQUEST["room_number"]));
            $room_name = trim(htmlspecialchars($_REQUEST["room_name"]));
            $room_type = trim(htmlspecialchars($_REQUEST["room_type"]));
            $no_persons = trim(htmlspecialchars($_REQUEST["no_of_persons"]));
            $room_price = trim(htmlspecialchars($_REQUEST["room_price"]));
            $ac_availablity = trim(htmlspecialchars($_REQUEST["inlineRadioOptions"]));

            if (!empty($room_number) && !empty($room_name) && !empty($room_type) && !empty($no_persons) && !empty($room_price) && !empty($ac_availablity)){
                $target_dir = "assets/images/rooms/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
                // Check if the file already exists
                if (file_exists($target_file)) {
                    echo "<script>alert('Sorry, file already exists.')</script>";
                    $uploadOk = 0;
                }
    
                // Allow only certain file formats
                if ($imageFileType != "webp" && $imageFileType != "jpg" && $imageFileType != "jpeg") {
                    echo "<script>alert('Sorry, only WEBP,JPG,JPEG files are allowed.')</script>";
                    $uploadOk = 0;
                }
    
                if ($uploadOk == 0) {
                    echo "<script>alert('Sorry, your file was not uploaded.')</script>";
                } else {
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        // Insert image path into the database
                        $query = "INSERT INTO rooms(room_number,room_name,room_image_path,room_type,no_persons,ac_availability,room_price) VALUES ($room_number,'$room_name','$target_file','$room_type',$no_persons,'$ac_availablity',$room_price)";
                        if (mysqli_query($conn, $query)) {
                            echo "<script>alert('Success')</script>";
                        } else {
                            echo "<script>alert('Sorry, there was an error')</script>";
                        }
                    } else {
                        echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
                    }
                }
            }          
        }
    ?>


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
                            <h2 class="pageheader-title">Add Room Details test</h2>
                            <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Rooms</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Add Room Details</li>
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
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="needs-validation" id="form" method="post" enctype="multipart/form-data" novalidate>
                                <div class="form-group row">
                                    <label for="roomNumber" class="col-lg-2 col-md-3 col-sm-3 col-xs-12 col-form-label">Room Number</label>
                                    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                                        <input type="number" class="form-control" id="roomNumber" name="room_number" placeholder="" required>
                                        <div class="invalid-feedback">
                                            Enter Room Number
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="roomName" class="col-lg-2 col-md-3 col-sm-3 col-xs-12 col-form-label">Room Name</label>
                                    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control" id="roomName" name="room_name" placeholder="" required>
                                        <div class="invalid-feedback">
                                            Enter Room Name
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="roomType" class="col-lg-2 col-md-3 col-sm-3 col-xs-12 col-form-label">Room Type</label>
                                    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control" id="roomType" name="room_type" placeholder="" required>
                                        <div class="invalid-feedback">
                                            Enter Room Type
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="persons" class="col-lg-2 col-md-3 col-sm-3 col-xs-12 col-form-label">No. of Persons</label>
                                    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                                        <input type="number" class="form-control" id="persons" name="no_of_persons" placeholder="" required>
                                        <div class="invalid-feedback">
                                            Enter Number of Persons
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="roomPrice" class="col-lg-2 col-md-3 col-sm-3 col-xs-12 col-form-label">Room Price</label>
                                    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                                        <input type="number" class="form-control" id="roomPrice" name="room_price" placeholder="" required>
                                        <div class="invalid-feedback">
                                            Enter Room Price
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="roomPicture" class="col-lg-2 col-md-3 col-sm-3 col-xs-12 col-form-label">Room Picture</label>
                                    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                                        <input type="file" accept="image/*" class="form-control" id="roomPicture" name="image" placeholder="" required>
                                        <div class="invalid-feedback">
                                            Upload Room Picture
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="persons" class="col-lg-2 col-md-3 col-sm-3 col-xs-12 col-form-label">AC Availability</label>
                                    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                                        <!-- <div class="switch-button switch-button-sm">
                                            <input type="checkbox" id="acAvailablity" name="ac_availablity" required>
                                            <span><label for="acAvailablity"></label></span>
                                            <div class="invalid-feedback">
                                                Enter Number of Persons
                                            </div>
                                        </div> -->

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="yes" required>
                                            <label class="form-check-label" for="inlineRadio1">Available</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="no" required>
                                            <label class="form-check-label" for="inlineRadio2">Not Available</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row pt-2 pt-sm-5 mt-1">
                                    <div class="col-sm-6">
                                        <p class="text-center">
                                            <input type="submit" class="btn btn-space btn-primary" name="submit">
                                            <input type="reset" class="btn btn-space btn-secondary">
                                        </p>
                                    </div>
                                </div>

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

</body>
 
</html>