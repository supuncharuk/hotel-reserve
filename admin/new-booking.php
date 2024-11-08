<?php
    require_once ("includes/config.php");
?>

<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>New Booking</title>
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
            $id = trim(htmlspecialchars($_REQUEST["id"]));
            $path_img = trim(htmlspecialchars($_REQUEST["image_path"]));
           
            if (!empty($room_number) && !empty($room_name) && !empty($room_type) && !empty($no_persons) && !empty($room_price) && !empty($ac_availablity)){
                
                if ($id != 0) {
                    $is_edit = true;
                }

                // Check if the room number already exists when adding a new room
                if (!$is_edit) {
                    $check_room_query = "SELECT * FROM rooms WHERE room_number = $room_number";
                    $check_result = mysqli_query($conn, $check_room_query);
                    
                    if (mysqli_num_rows($check_result) > 0) {
                        echo "<script>alert('Room number already exists. Please choose a different room number.');</script>";
                        exit;  // Stop further execution
                    }
                }
                
                if (!empty($_FILES["image"]["name"])){
                    $target_dir = "assets/images/rooms/";
                    $target_file = $target_dir . basename($_FILES["image"]["name"]);
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                    if ($imageFileType != "webp" && $imageFileType != "jpg" && $imageFileType != "jpeg") {
                        echo "<script>alert('Sorry, only WEBP,JPG,JPEG files are allowed.')</script>";
                    }else{
                        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                        $image_name = basename($_FILES["image"]["name"]);
                    }

                }else{
                    // For editing, retain the previous image if no new one is uploaded
                    $image_name = $is_edit ? $path_img : '';
                }

                // Insert or update logic based on whether it's an add or edit operation
                if ($is_edit){
                    // Update room details
                    $update_query = "UPDATE rooms SET room_name='$room_name', room_image_name='$image_name', room_type='$room_type', no_persons=$no_persons, ac_availability='$ac_availablity', room_price=$room_price WHERE room_number=$room_number";
                    if (mysqli_query($conn, $update_query)) {
                        echo "<script>alert('Room updated successfully'); window.location='room-details.php';</script>";
                    } else {
                        echo "<script>alert('Error updating room');</script>";
                    }
                }else{
                    // Insert new room details
                    $insert_query = "INSERT INTO rooms(room_number, room_name, room_image_name, room_type, no_persons, ac_availability, room_price) VALUES ($room_number, '$room_name', '$image_name', '$room_type', $no_persons, '$ac_availablity', $room_price)";
                    if (mysqli_query($conn, $insert_query)) {
                        echo "<script>alert('Room added successfully'); window.location='room-details.php';</script>";
                    } else {
                        echo "<script>alert('Error adding room');</script>";
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
                                        <input type="number" class="form-control" id="roomNumber" name="room_number"  placeholder="" required>
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