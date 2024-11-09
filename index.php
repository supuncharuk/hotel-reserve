<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Royal Hotel</title>
        
        <?php include_once ("includes/css-links-inc.php") ?>
    </head>
    <body>
        
        <?php include_once ("includes/header.php") ?>
        
        <!--================Banner Area =================-->
        <section class="banner_area">
            <div class="booking_table d_flex align-items-center">
            	<div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
				<div class="container">
					<div class="banner_content text-center">
						<h6>Away from monotonous life</h6>
						<h2>Relax Your Mind</h2>
						<p style="font-size:16px;">Indulge in luxury and comfort at our exquisite hotel.<br> Experience world-class service, elegant accommodations, and breathtaking views. Unwind in our serene oasis,<br> where every detail is meticulously crafted to provide an unforgettable stay.</p>
					</div>
				</div>
            </div>
        </section>
        <!--================Banner Area =================-->
        
        <!--================ Accomodation Area  =================-->
        <section class="accomodation_area section_gap">
            <div class="container">
                <div class="section_title text-center">
                    <h2 class="title_color">Popular Hotel Accomodation</h2>
                </div>
                <div class="row mb_30">
                    <?php
                        require_once ("admin/includes/config.php");
                        $sql = "SELECT * FROM rooms ORDER BY room_name DESC LIMIT 4";
                        $result = mysqli_query($conn,$sql);

                        if (mysqli_num_rows($result)>0){
                            while ($row = mysqli_fetch_assoc($result)){
                                $ac_available = ($row['ac_availability'] == "yes") ? "A/C" : "Non A/C";

                                echo "<div class='col-xl-3 col-lg-4 col-md-6 col-sm-12'>
                                    <div class='accomodation_item text-center'>
                                        <div class='hotel_img' style='display:inline-block;'>
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
        
        <?php include_once ("includes/facilities-area.php") ?>
        
        <?php include_once ("includes/testimonial-area.php") ?>
        
        <?php include_once ("includes/footer.php") ?>
        
        <?php include_once ("includes/js-links-inc.php") ?>

    </body>
</html>