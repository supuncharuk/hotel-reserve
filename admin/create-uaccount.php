<?php
  require_once ("includes/config.php");
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

                    $sql2 = "INSERT INTO users VALUES('$uname','$email','$password','1')";
                    $result2 = mysqli_query($conn,$sql2);

                    if ($result2){
                        echo "<script>alert('Create user account successfully')</script>";
                    }else{
                        echo "<script>alert('User account not created')</script>";
                    }
                }else{
                    echo "<script>alert('This username is already exists')</script>";
                }
            }else{
                echo "<script>alert('All fields required')</script>"
                ;
            }
        } 
    ?>


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
                        Passwords do not match
                    </div>
                </div>

                <div class="form-group pt-2">
                    <input type="submit" class="btn btn-block btn-primary" name="submit" value="Create Account">
                </div>
                <!-- <div class="form-group">
                    <label class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox"><span class="custom-control-label">By creating an account, you agree the <a href="#">terms and conditions</a></span>
                    </label>
                </div>
                <div class="form-group row pt-0">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-2">
                        <button class="btn btn-block btn-social btn-facebook " type="button">Facebook</button>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <button class="btn  btn-block btn-social btn-twitter" type="button">Twitter</button>
                    </div>
                </div> -->
            </div>

            <!-- <div class="card-footer bg-white">
                <p>Already member? <a href="index.php" class="text-secondary">Login Here.</a></p>
            </div> -->
        </div>
    </form>

    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/libs/js/main-js.js"></script>
    <script src="assets/libs/js/validation.js"></script>
</body>

 
</html>