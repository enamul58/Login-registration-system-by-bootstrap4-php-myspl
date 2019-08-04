<?php
    require_once 'vendor/autoload.php';
    $user = new App\classes\Users();
    //if(isset($_SESSION['logIn'])){session_start();}
     session_start();
     if(isset($_SESSION['logIn'])){
        header('Location: index.php');
     }
    if(isset($_POST['logIn'])){
       $message = $user->forLogIn($_POST);
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login Registration System</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/my-style.css" rel="stylesheet">


</head>

<body>

<!-- Navigation -->
<?php include 'assets/includes/menu.php';?>
<div class="container">
    <div class="row">
        <div class="col-lg-10 col-xl-9 mx-auto">
            <div class="card card-signin flex-row my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Login</h5>
                    <div class="col-md-6 m-auto">
                        <?php if(isset($message)) echo $message;?>
                        <form class="form-signin" action="" method="post">
                            <div class="form-label-group">
                                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" required autofocus>
                                <label for="inputEmail">Email address</label>
                            </div>

                            <div class="form-label-group">
                                <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
                                <label for="inputPassword">Password</label>
                            </div>

                            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="logIn">LogIn</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap core JavaScript -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>

