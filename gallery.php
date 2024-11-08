<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Gallery - Royal Hotel</title>
        
        <?php include_once ("includes/css-links-inc.php") ?>
        <link rel="stylesheet" href="assets/vendors/lightbox/simpleLightbox.css">
    </head>
    <body>
        
        <?php include_once ("includes/header.php") ?>
        
        <!--================Breadcrumb Area =================-->
        <section class="breadcrumb_area">
            <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" data-background=""></div>
            <div class="container">
                <div class="page-cover text-center">
                    <h2 class="page-cover-tittle">Gallery</h2>
                    <ol class="breadcrumb">
                        <li><a href="index.php">Home</a></li>
                        <li class="active">Gallery</li>
                    </ol>
                </div>
            </div>
        </section>
        <!--================Breadcrumb Area =================-->
        
        <!--================Breadcrumb Area =================-->
        <section class="gallery_area section_gap">
            <div class="container">
                <div class="section_title text-center">
                    <h2 class="title_color">Royal Hotel Gallery</h2>
                    <p>Who are in extremely love with eco friendly system.</p>
                </div>

                <?php
                    // Directory containing the gallery images
                    $target_dir = "admin/assets/images/gallery/";

                    // Scan the directory for files
                    $images = scandir($target_dir);

                    // Filter out the "." and ".." entries and keep only image files
                    $allowed_types = ['webp', 'jpg', 'jpeg'];
                    $image_files = array_filter($images, function($file) use ($target_dir, $allowed_types) {
                        $file_type = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                        return in_array($file_type, $allowed_types) && is_file($target_dir . $file);
                    });
                ?>

                <div class="row imageGallery1" id="gallery">

                    <?php
                        if (!empty($image_files)){
                            foreach ($image_files as $image){
                    ?>

                    <div class="col-md-4 gallery_item">
                        <div class="gallery_img">
                            <img src="<?php echo $target_dir . $image; ?>" alt="<?php echo pathinfo($image, PATHINFO_FILENAME); ?>">
                            <div class="hover">
                            	<a class="light" href="<?php echo $target_dir . $image; ?>"><i class="fa fa-expand"></i></a>
                            </div>
                        </div>
                    </div>

                    <?php } } ?>

                </div>
            </div>
        </section>
        <!--================Breadcrumb Area =================-->
        
        
        <?php include_once ("includes/footer.php") ?>
        
        <?php include_once ("includes/js-links-inc.php") ?>
        <!-- <script src="assets/vendors/lightbox/simpleLightbox.min.js"></script> -->
        
    </body>
</html>