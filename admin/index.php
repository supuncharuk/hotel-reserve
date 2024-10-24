<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
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
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center">
                <a href="index.php">
                    <img class="logo-img" src="assets/images/logo.png" alt="logo">
                </a>
                <span class="splash-description">Please enter your user information.</span>
            </div>
            <div class="card-body">
                <form action="" class="needs-validation" method="post" novalidate>
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="uname" name="uname" type="text" placeholder="Username" autocomplete="off" required>
                        <div class="invalid-feedback">
                            Enter your username
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="password" name="password" type="password" placeholder="Password" required>
                        <div class="invalid-feedback">
                            Enter your password
                        </div>    
                    </div>
                    
                    <!-- <div class="form-group">
                        <label class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox"><span class="custom-control-label" required>Remember Me</span>
                        </label>
                    </div> -->

                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="Sign in">

                </form>
            </div>
            <div class="card-footer bg-white p-0  ">
                <!-- <div class="card-footer-item card-footer-item-bordered">
                    <a href="create-uaccount.php" class="footer-link">Create An Account</a>
                </div> -->
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="forgot-password.php" class="footer-link">Forgot Password</a>
                </div>
            </div>
        </div>
    </div>
  
    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="assets/libs/js/validation.js"></script>

</body>
 
</html>