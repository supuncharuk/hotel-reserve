<?php
    session_start();
    require_once ("includes/config.php");

    if (isset($_SESSION['uname'])){
        $uname = $_SESSION['uname'];

        $sql = "SELECT * FROM users WHERE uname='$uname'";
        $result = mysqli_query($conn, $sql);
        $record = mysqli_fetch_assoc($result);

        if ($record['is_admin'] != 'yes'){
           header("location: index.php");
        }
    }else{
        header("location: index.php");
    }
?>

<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Create User Account</title>
    <link rel="icon" href="assets/images/logo/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="assets/libs/css/toast.css">

    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
        }
    </style>
</head>
<!-- ============================================================== -->
<!-- signup form  -->
<!-- ============================================================== -->

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

    <!-- ============================================================== -->
    <!-- signup form  -->
    <!-- ============================================================== -->
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="splash-container needs-validation" method="post" novalidate>
        <div class="card">
            <div class="card-header text-center">
                <a href="index.php">
                    <img class="logo-img" src="assets/images/logo.png" alt="logo">
                </a>
                <h3 class="mt-1 mb-1">Registrations Form</h3>
                <p>Please enter your user information.</p>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <input type="text" class="form-control form-control-lg" name="uname" placeholder="Username" autocomplete="off" required>
                    <div class="invalid-feedback">
                        Enter your username
                    </div>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control form-control-lg" name="email" placeholder="E-mail" autocomplete="off" required>
                    <div class="invalid-feedback">
                        Enter your email
                    </div>
                </div>

                <div class="form-group input-group">
                    <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="Password" required>
                    <div class="input-group-append">
                        <span class="input-group-text" style="border-radius:2px; cursor: pointer;" id="togglePassword"><i class="fa fa-eye" style="font-size:18px;" aria-hidden="true"></i></span>
                    </div>
                    <div class="invalid-feedback">
                        Enter your password
                    </div>
                </div>

                <div class="form-group input-group">
                    <input type="password" class="form-control form-control-lg" name="cpassword" id="cpassword" placeholder="Confirm Password" required>
                    <div class="input-group-append">
                        <span class="input-group-text" style="border-radius:2px; cursor: pointer;" id="toggleConfirmPassword"><i class="fa fa-eye" style="font-size:18px;" aria-hidden="true"></i></span>
                    </div>
                    <div class="invalid-feedback" id="confirmPasswordFeedback">
                        Passwords doesn't not match
                    </div>
                </div>

                <div class="form-group pt-2">
                    <input type="submit" class="btn btn-block btn-primary" name="submit" value="Create Account">
                </div>

                <a href="admin-home-page.php"><i class="fas fa-arrow-left"></i> &nbsp; Go to admin home page</a>
            </div>
        </div>
    </form>

    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/libs/js/main-js.js"></script>
    <script src="assets/libs/js/validation.js"></script>
    <script src="assets/libs/js/alert-toast.js"></script>


    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST["submit"])){
            $uname = trim(htmlspecialchars($_REQUEST["uname"]));
            $email = trim(htmlspecialchars($_REQUEST["email"]));
            $password = trim(htmlspecialchars($_REQUEST["password"]));

            if (!empty($uname) && !empty($email) && !empty($password)){
                $sql = "SELECT * FROM users WHERE uname='$uname'";
                $result = mysqli_query($conn,$sql);

                if (mysqli_num_rows($result)==0){
                    $password = password_hash($password, PASSWORD_DEFAULT);

                    $sql2 = "INSERT INTO users VALUES('$uname','$email','$password','no','1')";
                    $result2 = mysqli_query($conn,$sql2);

                    if ($result2){
                        // echo "<script>alert('Create user account successfully')</script>";
                        $alert_type = "success";
                        $alert_message = "Created user account successfully";
                        $redirect_url = "admin-dashboard.php";
                    }else{
                        // echo "<script>alert('User account not created')</script>";
                        $alert_type = "error";
                        $alert_message = "User account not created";
                        $redirect_url = "";
                    }
                }else{
                    // echo "<script>alert('This username is already exists')</script>";
                    $alert_type = "error";
                    $alert_message = "This username is already exists";
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


</body>

 
</html>