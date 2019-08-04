<?php
require_once 'vendor/autoload.php';
$users = new \App\classes\Users();
session_start();
$id = $_GET['id'];
    if(isset($_POST['btn'])){
        $queryResult = $users->changePassword($_POST);
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
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
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
                    <h5 class="card-title text-center">Change Password</h5>
                    <div class="col-md-6 m-auto">
                        <?php if(isset($_SESSION['changePassword'])) echo $_SESSION['changePassword'];?>
                        <form class="form-signin" action="" method="post">
                            <div class="form-label-group">
                                <input type="password" class="form-control" placeholder="Password" name="password"  required autofocus>
                                <input type="hidden"  class="form-control" placeholder="Username" name="id" value="<?php echo $id;?>">
                                <label>Password</label>
                            </div>

                            <div class="form-label-group">
                                <input type="password" class="form-control" placeholder="New Password" name="new_password" required>
                                <label>New password</label>
                            </div>
                            <?php if($_SESSION['id']==$id){?>
                                <button class="btn btn-secondary text-uppercase" type="submit" name="btn">Update</button>
                            <?php } ?>
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



