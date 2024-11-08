<?php
    require_once ("includes/config.php");

    $is_edit = false;  // Flag to determine if it's an edit operation

    // Fetch room details if room_id is present in the URL (for editing)
    if (isset($_GET['room_id'])) {
        $is_edit = true;
        $room_id = $_GET['room_id'];
        $sql = "SELECT * FROM rooms WHERE room_number = $room_id";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            $room = mysqli_fetch_row($result);
        } else {
            echo "<script>alert('Room not found.')</script>";
        }
    }
?>

<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $is_edit ? "Edit Room Details" : "Add Room Details"; ?></title>
    <link rel="icon" href="assets/images/logo/favicon.png">
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
                            <h2 class="pageheader-title"><?php echo $is_edit ? "Edit Room Details" : "Add Room Details"; ?></h2>
                            <!-- <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p> -->
                            <?php if (!$is_edit){ ?>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Rooms</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Add Room Details</li>
                                        </ol>
                                    </nav>
                                </div>                                    
                            <?php } ?>        
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
                                <input type="hidden" name="id" value="<?php echo $is_edit ? $room[0] : 0 ; ?>">
                                <input type="hidden" name="image_path" value="<?php echo $is_edit ? $room[2] : '' ; ?>">
                                <div class="form-group row">
                                    <label for="roomNumber" class="col-lg-2 col-md-3 col-sm-3 col-xs-12 col-form-label">Room Number</label>
                                    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                                        <input type="number" class="form-control" id="roomNumber" name="room_number" value="<?php echo $is_edit ? $room[0] : ''; ?>" <?php echo $is_edit ? 'readonly' : ''; ?> placeholder="" required>
                                        <div class="invalid-feedback">
                                            Enter Room Number
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="roomName" class="col-lg-2 col-md-3 col-sm-3 col-xs-12 col-form-label">Room Name</label>
                                    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control" id="roomName" name="room_name" value="<?php echo $is_edit ? $room[1] : ''; ?>" placeholder="" required>
                                        <div class="invalid-feedback">
                                            Enter Room Name
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="roomType" class="col-lg-2 col-md-3 col-sm-3 col-xs-12 col-form-label">Room Type</label>
                                    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control" id="roomType" name="room_type" value="<?php echo $is_edit ? $room[3] : ''; ?>" placeholder="" required>
                                        <div class="invalid-feedback">
                                            Enter Room Type
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="persons" class="col-lg-2 col-md-3 col-sm-3 col-xs-12 col-form-label">No. of Persons</label>
                                    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                                        <input type="number" class="form-control" id="persons" name="no_of_persons" value="<?php echo $is_edit ? $room[4] : ''; ?>" placeholder="" required>
                                        <div class="invalid-feedback">
                                            Enter Number of Persons
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="roomPrice" class="col-lg-2 col-md-3 col-sm-3 col-xs-12 col-form-label">Room Price</label>
                                    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                                        <input type="number" class="form-control" id="roomPrice" name="room_price" value="<?php echo $is_edit ? $room[6] : ''; ?>" placeholder="" required>
                                        <div class="invalid-feedback">
                                            Enter Room Price
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="roomPicture" class="col-lg-2 col-md-3 col-sm-3 col-xs-12 col-form-label">Room Picture</label>
                                    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                                        <?php if ($is_edit && $room[2]){ ?>
                                            <input type="file" accept="image/*" class="form-control" id="roomPicture" name="image" placeholder="">
                                            <img src="assets/images/rooms/<?php echo $room[2]; ?>" alt="Room Image" style="width:50px; height:50px; cursor:pointer;" data-toggle="modal" data-target="#imageModal<?php echo $room[0]; ?>">
                                        <?php } else { ?>
                                            <input type="file" accept="image/*" class="form-control" id="roomPicture" name="image" placeholder="" required>
                                        <?php } ?>
                                        <div class="invalid-feedback">
                                            Upload Room Picture
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal for view room image -->
                                <div class="modal fade pr-0" id="imageModal<?php echo $room[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"><?php echo $room[1] ?></h5>
                                                <a href="#" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
                                            </div>
                                            <div class="modal-body">
                                                <img src="assets/images/rooms/<?php echo $room[2] ?>" style="width:100%;">
                                            </div>
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
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="yes" <?php echo $is_edit && $room[5] == 'yes' ? 'checked' : ''; ?> required>
                                            <label class="form-check-label" for="inlineRadio1">Available</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="no" <?php echo $is_edit && $room[5] == 'no' ? 'checked' : ''; ?> required>
                                            <label class="form-check-label" for="inlineRadio2">Not Available</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row pt-2 pt-sm-5 mt-1">
                                    <div class="col-sm-6">
                                        <p class="text-center">
                                            <input type="submit" class="btn btn-space btn-primary" name="submit" value="<?php echo $is_edit ? "Update" : "Submit"; ?>">
                                            <?php if (!$is_edit){ ?>
                                                <input type="reset" class="btn btn-space btn-secondary">
                                            <?php } ?>                             
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