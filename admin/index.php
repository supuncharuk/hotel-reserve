<?php
    require_once ("includes/login-inc.php");
?>
<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
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
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center">
                <a href="index.php">
                    <img class="logo-img" src="assets/images/logo/logo-1.png" alt="logo">
                </a>
                <!-- <span class="splash-description">Please enter your user information.</span> -->
            </div>
            <div class="card-body">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="needs-validation" method="post" novalidate>
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="uname" name="uname" type="text" placeholder="Username" value="<?php echo isset($uname) ? $uname : '' ?>" required>
                        <div class="invalid-feedback">
                            Enter your username
                        </div>
                    </div>
                    
                    <div class="form-group input-group">
                        <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="Password" value="<?php echo isset($password) ? $password : '' ?>" required>
                        <div class="input-group-append">
                            <span class="input-group-text" style="border-radius:2px; cursor: pointer;" id="togglePassword"><i class="fa fa-eye" style="font-size:18px;" aria-hidden="true"></i></span>
                        </div>
                        <div class="invalid-feedback">
                            Enter your password
                        </div>
                    </div>

                    <input type="submit" class="btn btn-primary btn-lg btn-block" name="login" value="Login">

                </form>
            </div>
            <!-- <div class="card-footer bg-white p-0  ">
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="forgot-password.php" class="footer-link">Forgot Password</a>
                </div>
            </div> -->
        </div>
    </div>
  
    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/libs/js/main-js.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="assets/libs/js/validation.js"></script>
    <script src="assets/libs/js/alert-toast.js"></script>

</body>
 
</html>