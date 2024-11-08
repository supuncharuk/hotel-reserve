<?php
    session_start();

    if (!isset($_SESSION['uname'])){
        header("location: index.php");
    }
?>

<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Manage Gallery</title>
    <link rel="icon" href="assets/images/logo/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/buttons.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/select.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/fixedHeader.bootstrap4.css">
    <link rel="stylesheet" href="assets/libs/css/toast.css">

    <style>
        table th,tr{
            text-align: center;
        }
    </style>
</head>

<body>

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

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST["upload"])){
            if (!empty($_FILES["gallery_image"]["name"])){
                $target_dir = "assets/images/gallery/";
                $target_file = $target_dir . basename($_FILES["gallery_image"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
                if ($imageFileType != "webp" && $imageFileType != "jpg" && $imageFileType != "jpeg") {
                    // echo "<script>alert('Sorry, only WEBP,JPG,JPEG files are allowed.')</script>";
                    $alert_type = "error";
                    $alert_message = "Sorry, only WEBP,JPG,JPEG files are allowed";
                    $redirect_url = "";
                }else{
                    if (file_exists($target_file)){
                        // echo "<script>alert('Sorry, image already exists.')</script>";
                        $alert_type = "error";
                        $alert_message = "Sorry, image already exists";
                        $redirect_url = "";
                    }else{
                        if (move_uploaded_file($_FILES["gallery_image"]["tmp_name"], $target_file)) {
                            // echo "<script>alert('Image has been uploaded successfully')</script>";
                            $alert_type = "success";
                            $alert_message = "Image has been uploaded successfully";
                            $redirect_url = "";
                        } else {
                            echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
                            $alert_type = "error";
                            $alert_message = "Sorry, there was an error uploading your file";
                            $redirect_url = "";
                        }
                    }
                }
    
            }

            // Pass variables to JavaScript
            echo "<script>
                var alertType = '$alert_type';
                var alertMessage = '$alert_message';
                var redirectUrl = '$redirect_url';
             </script>";
        }

        // If the delete button is clicked
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST["delete_image"])){
            $target_dir = "assets/images/gallery/";
            $image_to_delete = $_POST['delete_image'];
            $image_path = $target_dir . basename($image_to_delete);

            // Check if the file exists and then delete it
            if (file_exists($image_path)) {
                if (unlink($image_path)) {
                    // echo "<script>alert('Image has been deleted successfully.')</script>";
                    $alert_type = "success";
                    $alert_message = "Image has been deleted successfully";
                    $redirect_url = "";
                } else {
                    // echo "<script>alert('Sorry, there was an error deleting the image.')</script>";
                    $alert_type = "error";
                    $alert_message = "Sorry, there was an error deleting the image";
                    $redirect_url = "";
                }
            } else {
                // echo "<script>alert('Image does not exist.')</script>";
                $alert_type = "error";
                $alert_message = "Image does not exist";
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
                            <h2 class="pageheader-title">Manage Gallery</h2>
                            <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="admin-home-page.php" class="breadcrumb-link">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Manage Gallery</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->

                <div class="card">
                    <h5 class="card-header">Add new gallery image</h5>
                    <div class="card-body">
                        <div class="">
                            <!-- <h4>Live Demo</h4> -->
                            <!-- Button trigger modal -->
                            <button class="btn btn-primary" data-toggle="modal" data-target="#uploadGalleryImageModal">Click to add new gallery image</button>
                            <!-- Modal -->
                            <div class="modal fade" id="uploadGalleryImageModal" tabindex="-1" role="dialog" aria-labelledby="uploadGalleryImageModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="uploadGalleryImageModalLabel">New gallery image</h5>
                                            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </a>
                                        </div>

                                        <div class="modal-body">
                                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="needs-validation" id="form" method="post" enctype="multipart/form-data" novalidate>
                                                <div class="form-group row">
                                                    <label for="galleryImage" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-form-label">Gallery Image</label>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">       
                                                        <input type="file" accept="image/*" class="form-control" id="galleryImage" name="gallery_image" placeholder="" required>
                                                        <div class="invalid-feedback">
                                                            Upload Gallery Image
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-end mt-3">
                                                    <button class="btn btn-secondary" style="margin-right:4px;" data-dismiss="modal">Close</button>
                                                    <input type="submit" class="btn btn-primary" style="margin-left:4px;" value="Upload" name="upload">
                                                </div>
                                            </form>
                                        </div>

                                        <!-- <div class="modal-footer">
                                            <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                                            <a href="#" class="btn btn-primary">Save changes</a>
                                        </div> -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Gallery Images</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">

                                    <?php
                                        // Directory containing the gallery images
                                        $target_dir = "assets/images/gallery/";

                                        // Scan the directory for files
                                        $images = scandir($target_dir);

                                        // Filter out the "." and ".." entries and keep only image files
                                        $allowed_types = ['webp', 'jpg', 'jpeg'];
                                        $image_files = array_filter($images, function($file) use ($target_dir, $allowed_types) {
                                            $file_type = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                                            return in_array($file_type, $allowed_types) && is_file($target_dir . $file);
                                        });
                                    ?>

                                    <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Image Name</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody> 
                                            <?php 
                                                if(!empty($image_files)){
                                                    $row_id=1;
                                                    foreach($image_files as $image){
                                            ?>
                                            <tr>
                                                <td><?php echo $row_id ?></td>
                                                <td><?php echo pathinfo($image, PATHINFO_FILENAME); // File name without extension ?></td>
                                                <td>
                                                    <img src="<?php echo $target_dir . $image; ?>" width="50" height="50" style="cursor:pointer;" data-toggle="modal" data-target="#viewImage<?php echo $row_id ?>">
                                                </td>                                 
                                                <td>
                                                    <!-- Form to delete the image -->
                                                    <form method="POST" onsubmit="return confirm('Are you sure you want to delete this image?');">
                                                        <input type="hidden" name="delete_image" value="<?php echo $image; ?>">
                                                        <button type="submit" class="btn btn-danger btn-sm ml-2">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>                                               
                                            </tr>    
                                            
                                            <!-- Modal for view room image -->
                                            <div class="modal fade pr-0" id="viewImage<?php echo $row_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"><?php echo $image ?></h5>
                                                            <a href="#" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
                                                        </div>
                                                        <div class="modal-body">
                                                            <img src="assets/images/gallery/<?php echo $image ?>" style="width:100%;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php
                                                $row_id++; } }
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
    <script src="assets/libs/js/validation.js"></script>

    <script src="assets/libs/js/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/libs/js/dataTables.buttons.min.js"></script>
    <script src="assets/vendor/datatables/js/buttons.bootstrap4.min.js"></script>
    <script src="assets/vendor/datatables/js/data-table.js"></script>
    <script src="assets/libs/js/alert-toast.js"></script>

</body>
 
</html>