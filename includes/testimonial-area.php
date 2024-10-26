<!--================ Testimonial Area  =================-->
<section class="testimonial_area section_gap">
    <div class="container">
        <div class="section_title text-center">
            <h2 class="title_color">Testimonial from our Clients</h2>
            <p>The French Revolution constituted for the conscience of the dominant aristocratic class a fall from </p>
        </div>

        <?php
            require_once ("./admin/includes/config.php");

            $sql = "SELECT * FROM testimonials";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result)>0){
        ?>
                <div class="testimonial_slider owl-carousel">

                    <?php
                        while ($record = mysqli_fetch_row($result)){
                    ?>

                    <div class="media testimonial_item">
                        <img class="rounded-circle" src="admin/assets/images/testimonials/clients/<?php echo $record[2] ?>" alt="" width="80" height="80">
                        <div class="media-body">
                            <p><?php echo $record[3] ?></p>
                            <h4 class="sec_h4"><?php echo $record[1] ?></h4>
                            <div class="star">
                                <?php
                                    $star = $record[4];
                                    $all = 5;
                                    $none = $all - $star;

                                    for ($i=1; $i<=$star; $i++){
                                        echo "<i class='fas fa-star' style='color:#FFD43B; font-size:18px;'></i>";
                                    }

                                    if ($none>0){
                                        for ($j=1; $j<=$none; $j++){
                                            echo "<i class='far fa-star' style='color:#FFD43B; font-size:18px;'></i>";
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </div> 

                    <?php } ?>

                </div>
        <?php } ?>
        
    </div>
</section>
<!--================ Testimonial Area  =================-->