<?php
    require_once ("config.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST["login"])){
        $uname = trim(htmlspecialchars($_REQUEST["uname"]));
        $password = trim(htmlspecialchars($_REQUEST["password"]));

        if (!empty($uname) && !empty($password)){
            $sql = "SELECT * FROM users WHERE uname='$uname'";
            $result = mysqli_query($conn,$sql);

            if (mysqli_num_rows($result) > 0){
                $record = mysqli_fetch_assoc($result);

                $hashed_password = $record['upassword'];

                // Verify the entered password against the hashed password
                if (password_verify($password, $hashed_password)) {
                    session_start();
                    $_SESSION['uname'] = $uname;
                    header("Location: admin-dashboard.php");
                    exit();
                } else {
                    $alert_type = "error";
                    $alert_message = "Incorrect Password";
                    $redirect_url = "";
                }
                
            }else{
                $alert_type = "error";
                $alert_message = "Invalid Username";
                $redirect_url = "";
            }

        }else{
            // echo "<script>alert('All fields required')</script>";
            $alert_type = "error";
            $alert_message = "All fields required";
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