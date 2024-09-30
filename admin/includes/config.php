<?php
    // $dbhost = "localhost";
    // $dbuser = "u321305506_hotelre_user";
    // $dbpass = "Wtv@562@";
    // $dbname = "hotel";

    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "hotel";
    
    // Create connection
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    // Check connection
    if (!$conn) {
        $error = htmlspecialchars(mysqli_connect_error());
        $output = "
            <div class='row'>
                <div class='col'>
                    <h1 class='text-danger'>Error occurred</h1>
                    <h6 class='text-dark'>$error</h6>
                </div>
            </div>
        ";
        exit($output);
    }

    // Set character set and timezone
    mysqli_set_charset($conn, "utf8");
    mysqli_query($conn, "SET time_zone = '+5:30'");
?>
