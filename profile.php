<?php
    require_once 'vendor/autoload.php';
    $users = new \App\classes\Users();
    session_start();
    //id come from view of index page
    if($_SESSION['logIn']==null){
        header('Location: login.php');
    }
    $id = $_GET['id'];
    //call showAllUserInfoById method get info by id
     $queryResult = $users->showAllUserInfoById($id);
     $repository = mysqli_fetch_array($queryResult);
     $user = $repository;
     //go to update profile info by id
     if(isset($_POST['btn'])){
         $queryResult = $users->showAllUserInfoUpdateById($_POST);
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
                    <h5 class="card-title text-center">Profile</h5>
                    <div class="col-md-6 m-auto">
<!--                        --><?php //if(isset($queryResult)) echo $queryResult;?>
                    <form class="form-signin" action="" method="post">
                        <div class="form-label-group">
                            <input type="text"  class="form-control" placeholder="Username" name="name" value="<?php echo $user['name'];?>" required autofocus>
                            <input type="hidden"  class="form-control" placeholder="Username" name="id" value="<?php echo $user['id'];?>" required autofocus>
                            <label>name</label>
                        </div>
                        <div class="form-label-group">
                            <input type="text" class="form-control" placeholder="Username" name="user_name" value="<?php echo $user['username']?>" required>
                            <label>Username</label>
                        </div>

                        <div class="form-label-group">
                            <input type="email" class="form-control" placeholder="Email address" name="email" value="<?php echo $user['email'];?>" required>
                            <label>Email address</label>
                        </div>
                        <?php if($_SESSION['id']==$id){?>
                            <button class="btn btn-secondary text-uppercase" type="submit" name="btn">Update</button>
                            <a class="btn btn-secondary text-uppercase" type="submit" href="change-password.php?id=<?php echo $id?>">Change Password</a>
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


