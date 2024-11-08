<?php
    session_start();

    if (!isset($_SESSION['uname'])){
        header("location: index.php");
    }

    require_once ("includes/config.php");

    $is_edit = false;  // Flag to determine if it's an edit operation

    // Fetch room details if room_id is present in the URL (for editing)
    if (isset($_GET['id'])) {
        $is_edit = true;
        $id = $_GET['id'];
        $sql = "SELECT * FROM testimonials WHERE testimonial_id = $id";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            $testimonial = mysqli_fetch_row($result);
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
    <title><?php echo $is_edit ? "Edit Testimonial Details" : "Add New Testimonial"; ?></title>
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
            $client_name = trim(htmlspecialchars($_REQUEST["client_name"]));
            $testimonial_description = trim(htmlspecialchars($_REQUEST["testimonial_description"]));
            $star_rating = trim(htmlspecialchars($_REQUEST["star_rating"]));
            $id = trim(htmlspecialchars($_REQUEST["id"]));
            $path_img = trim(htmlspecialchars($_REQUEST["get_image_name"]));
           
            if (!empty($client_name) && !empty($testimonial_description) && !empty($star_rating)){
                
                if ($id != 0) {
                    $is_edit = true;
                }

                // // Check if the room number already exists when adding a new room
                // if (!$is_edit) {
                //     $check_room_query = "SELECT * FROM rooms WHERE room_number = $room_number";
                //     $check_result = mysqli_query($conn, $check_room_query);
                    
                //     if (mysqli_num_rows($check_result) > 0) {
                //         echo "<script>alert('Room number already exists. Please choose a different room number.');</script>";
                //         exit;  // Stop further execution
                //     }
                // }
                
                if (!empty($_FILES["client_image"]["name"])){
                    $target_dir = "assets/images/testimonials/clients/";
                    $target_file = $target_dir . basename($_FILES["client_image"]["name"]);
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                    if ($imageFileType != "webp" && $imageFileType != "jpg" && $imageFileType != "jpeg") {
                        echo "<script>alert('Sorry, only WEBP,JPG,JPEG files are allowed.')</script>";
                    }else{
                        move_uploaded_file($_FILES["client_image"]["tmp_name"], $target_file);
                        $image_name = basename($_FILES["client_image"]["name"]);
                    }

                }else{
                    // For editing, retain the previous image if no new one is uploaded
                    $image_name = $is_edit ? $path_img : '';
                }

                // Insert or update logic based on whether it's an add or edit operation
                if ($is_edit){
                    // Update room details
                    $update_query = "UPDATE testimonials SET client_name='$client_name', client_image_name='$image_name', testimonial_description='$testimonial_description', star_rating=$star_rating WHERE testimonial_id=$id";
                    if (mysqli_query($conn, $update_query)) {
                        echo "<script>alert('Testmonial updated successfully'); window.location='';</script>";
                    } else {
                        echo "<script>alert('Error updating testimonial');</script>";
                    }
                }else{
                    // Insert new room details
                    $insert_query = "INSERT INTO testimonials(client_name, client_image_name, testimonial_description, star_rating) VALUES ('$client_name', '$image_name', '$testimonial_description', $star_rating)";
                    if (mysqli_query($conn, $insert_query)) {
                        echo "<script>alert('Testmonial added successfully'); window.location='';</script>";
                    } else {
                        echo "<script>alert('Error adding Testmonial');</script>";
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
                            <h2 class="pageheader-title"><?php echo $is_edit ? "Edit Testimonial Details" : "Add New Testimonial"; ?></h2>
                            <!-- <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p> -->
                            <?php if (!$is_edit){ ?>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Testimonials</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Add New Testimonial</li>
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
                        <h5 class="card-header"><?php echo $is_edit ? "Testimonial Details" : "New Testimonial"; ?></h5>
                        <div class="card-body">
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="needs-validation" id="form" method="post" enctype="multipart/form-data" novalidate>
                                <input type="hidden" name="id" value="<?php echo $is_edit ? $testimonial[0] : 0 ; ?>">
                                <input type="hidden" name="get_image_name" value="<?php echo $is_edit ? $testimonial[2] : '' ; ?>">                             

                                <div class="form-group row">
                                    <label for="clientName" class="col-lg-2 col-md-3 col-sm-3 col-xs-12 col-form-label">Client Name</label>
                                    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control" id="clientName" name="client_name" value="<?php echo $is_edit ? $testimonial[1] : ''; ?>" required>
                                        <div class="invalid-feedback">
                                            Enter Client Name
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="clientImage" class="col-lg-2 col-md-3 col-sm-3 col-xs-12 col-form-label">Client Image</label>
                                    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                                        <?php if ($is_edit && $testimonial[2]){ ?>
                                            <input type="file" accept="image/*" class="form-control" id="clientImage" name="client_image">
                                            <img src="assets/images/testimonials/clients/<?php echo $testimonial[2]; ?>" style="width:50px; height:50px; cursor:pointer;" data-toggle="modal" data-target="#imageModal<?php echo $testimonial[0]; ?>">
                                        <?php } else { ?>
                                            <input type="file" accept="image/*" class="form-control" id="clientImage" name="client_image" placeholder="" required>
                                        <?php } ?>
                                        <div class="invalid-feedback">
                                            Upload Client Image
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="testimonialDescription" class="col-lg-2 col-md-3 col-sm-3 col-xs-12 col-form-label">Description</label>
                                    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                                        <textarea class="form-control" id="testimonialDescription" name="testimonial_description" required><?php echo $is_edit ? $testimonial[3] : '' ; ?></textarea>
                                        <div class="invalid-feedback">
                                            Enter Testimonial Description
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="starRating" class="col-lg-2 col-md-3 col-sm-3 col-xs-12 col-form-label">Star Rating</label>
                                    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                                        <select class="form-control" id="starRating" name="star_rating" required>
                                            <?php $star = ($testimonial[4]) ? $testimonial[4] : '' ?>
                                            <option value="" <?php echo empty($star) ? 'selected' : ''; ?> disabled>Select Rating</option>
                                            <?php for ($i=1; $i<=5; $i++){ ?>
                                                <option value='<?php echo $i ?>' <?php echo ($star == $i) ? 'selected' : ''; ?>><?php echo $i ?> Star</option>
                                            <?php } ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            Select Star Rating
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal for view room image -->
                                <div class="modal fade pr-0" id="imageModal<?php echo $testimonial[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"><?php echo $testimonial[1] ?></h5>
                                                <a href="#" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
                                            </div>
                                            <div class="modal-body">
                                                <img src="assets/images/testimonials/clients/<?php echo $testimonial[2] ?>" style="width:100%;">
                                            </div>
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