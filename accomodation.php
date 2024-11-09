<?php
  require_once ("admin/includes/config.php");
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Accomodation - Royal Hotel</title>
        
        <?php include_once ("includes/css-links-inc.php") ?>
    </head>
    <body>
        
        <?php include_once ("includes/header.php") ?>
        
        <!--================Breadcrumb Area =================-->
        <section class="breadcrumb_area">
            <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" data-background=""></div>
            <div class="container">
                <div class="page-cover text-center">
                    <h2 class="page-cover-tittle">Accomodation</h2>
                    <ol class="breadcrumb">
                        <li><a href="index.php">Home</a></li>
                        <li class="active">Accomodation</li>
                    </ol>
                </div>
            </div>
        </section>
        <!--================Breadcrumb Area =================-->
        
        <!--================ Accomodation Area  =================-->
        <section class="accomodation_area section_gap" style="padding-bottom: 60px">
            <div class="container">
                <div class="section_title text-center">
                    <h2 class="title_color">Special Accomodation</h2>
                </div>

                <div class="row mb_30">
                    <?php
                        $sql = "SELECT * FROM rooms where room_type='special'";
                        $result = mysqli_query($conn,$sql);

                        if (mysqli_num_rows($result)>0){
                            while ($row = mysqli_fetch_assoc($result)){
                                $ac_available = ($row['ac_availability'] == "yes") ? "A/C" : "Non A/C";

                                echo "<div class='col-lg-3 col-sm-6'>
                                    <div class='accomodation_item text-center'>
                                        <div class='hotel_img'>
                                            <img src='admin/assets/images/rooms/" .$row['room_image_name']. "' alt=''>
                                            <a href='booking-details.php?room_id=".$row['room_number']."' class='btn theme_btn button_hover'>Book Now</a>
                                        </div>
                                        <a href='#'><h4 class='sec_h4'>".$row['room_name']."</h4></a>
                                        <h5>Rs. ".number_format($row['room_price'],2)."<small>/night</small></h5>
                                        <h6>$ac_available, ".$row['no_persons']." Persons</h5>
                                    </div>
                                </div>";
                            }
                        }
                    ?>
                </div>

            </div>
        </section>
        <!--================ Accomodation Area  =================-->
        
        <!--================ Accomodation Area  =================-->
        <section class="accomodation_area section_gap">
            <div class="container">
                <div class="section_title text-center">
                    <h2 class="title_color">Normal Accomodation</h2>
                </div>

                <div class="row accomodation_two">
                    <?php
                        $sql = "SELECT * FROM rooms where room_type='normal'";
                        $result = mysqli_query($conn,$sql);

                        if (mysqli_num_rows($result)>0){
                            while ($row = mysqli_fetch_assoc($result)){
                                $ac_available = ($row['ac_availability'] == "yes") ? "A/C" : "Non A/C";

                                echo "<div class='col-lg-3 col-sm-6'>
                                    <div class='accomodation_item text-center'>
                                        <div class='hotel_img'>
                                            <img src='admin/assets/images/rooms/" .$row['room_image_name']. "' alt=''>
                                            <a href='booking-details.php?room_id=".$row['room_number']."' class='btn theme_btn button_hover'>Book Now</a>
                                        </div>
                                        <a href='#'><h4 class='sec_h4'>".$row['room_name']."</h4></a>
                                        <h5>Rs. ".number_format($row['room_price'],2)."<small>/night</small></h5>
                                        <h6>$ac_available, ".$row['no_persons']." Persons</h5>
                                    </div>
                                </div>";
                            }
                        }
                    ?>
                </div>

            </div>
        </section>
        <!--================ Accomodation Area  =================-->
        
        <?php include_once ("includes/testimonial-area.php") ?>
        
        <?php include_once ("includes/footer.php") ?>
        
        <?php include_once ("includes/js-links-inc.php") ?>
    </body>
</html>