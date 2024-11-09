<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Contact - Royal Hotel</title>
        
        <?php include_once ("includes/css-links-inc.php") ?>
    </head>
    <body>
        
        <?php include_once ("includes/header.php") ?>
        
        <!--================Breadcrumb Area =================-->
        <section class="breadcrumb_area">
            <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" data-background=""></div>
            <div class="container">
                <div class="page-cover text-center">
                    <h2 class="page-cover-tittle">Contact Us</h2>
                    <ol class="breadcrumb">
                        <li><a href="index.php">Home</a></li>
                        <li class="active">Contact Us</li>
                    </ol>
                </div>
            </div>
        </section>
        <!--================Breadcrumb Area =================-->
        
        <!--================Contact Area =================-->
        <section class="contact_area" style="padding: 80px 0;">
            <div class="container">
                <!-- <div id="mapBox" class="mapBox" 
                    data-lat="40.701083" 
                    data-lon="-74.1522848" 
                    data-zoom="13" 
                    data-info="PO Box CT16122 Collins Street West, Victoria 8007, Australia."
                    data-mlat="40.701083"
                    data-mlon="-74.1522848">
                </div> -->
                <div class="mapBox">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15869.784939429943!2d80.22398599464144!3d6.070401952648841!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae171822e7bd59d%3A0xe1c81807646b133!2sLabuduwa%2C%20Galle!5e0!3m2!1sen!2slk!4v1726277445187!5m2!1sen!2slk" width="100%" height="450" style="border:0;" allowfullscreen="" loading="async" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="contact_info">
                            <div class="info_item">
                                <i class="lnr lnr-home"></i>
                                <h6>Labuduwa, Galle</h6>
                                <p>Send us your thoughts</p>
                            </div>
                            <div class="info_item">
                                <i class="lnr lnr-phone-handset"></i>
                                <h6><a href="tel:+94767861171">+94 76 786 1171</a></h6>
                                <p>Mon to Fri 9am to 6 pm</p>
                            </div>
                            <div class="info_item">
                                <i class="lnr lnr-envelope"></i>
                                <h6><a href="mailto:navodyaga2001@gmail.com">navodyaga2001@gmail.com</a></h6>
                                <p>Send us your query anytime!</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <form class="row contact_form" action="" method="post" novalidate>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter Subject" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea class="form-control" name="message" id="message" rows="1" placeholder="Enter Message" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 text-right">
                                <input type="submit" value="submit" class="btn theme_btn button_hover" value="Send Message">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!--================Contact Area =================-->
        
        <?php include_once ("includes/testimonial-area.php") ?>
        
        <?php include_once ("includes/footer.php") ?>

        <!--================End Contact Success and Error message Area =================-->
        
        <?php include_once ("includes/js-links-inc.php") ?>
        
        <script src="assets/vendors/imagesloaded/imagesloaded.pkgd.min.js"></script>
        <script src="assets/vendors/isotope/isotope-min.js"></script>
        <script src="assets/js/stellar.js"></script>
        <script src="assets/js/validation.js"></script>
        
    </body>
</html>