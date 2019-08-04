<?php
   require_once 'vendor/autoload.php';
   $users = new \App\classes\Users();
   session_start();
    if($_SESSION['logIn']==null){
        header('Location: login.php');
    }

    //at index page display all user info
    $queryResult = $users->showAllUserInfo();
    $repository = mysqli_fetch_array($queryResult);

    //go for logout and session destroy
    if(isset($_GET['logOut'])){
       $users->logOut();
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

</head>

<body>

  <!-- Navigation -->
   <?php include 'assets/includes/menu.php';?>
   <div class="container">
       <div class="card mt-5">
           <div class="card-header">
               <h4 class="card-title">User list</h4>
           </div>
           <div class="card-body">

               <table class="table table-hover">
                   <thead class="thead-light">
                   <tr>
                       <th scope="col">#SL NO</th>
                       <th scope="col">Name</th>
                       <th scope="col">Username</th>
                       <th scope="col">Email</th>
                       <th scope="col">Action</th>
                   </tr>
                   </thead>
                   <tbody>
                   <?php $i = 1;
                        while($repository){
                            $user = $repository;
                   ?>
                   <tr>
                       <th scope="row"><?php echo $i++;?></th>
                       <td><?php echo $user['name'];?></td>
                       <td><?php echo $user['username'];?></td>
                       <td><?php echo $user['email'];?></td>
                       <td><a class="btn btn-primary" href="profile.php?id=<?php echo $user['id'];?>">View</a></td>
                   </tr>
                     <?php $repository = mysqli_fetch_array($queryResult);?>
                   <?php } ?>
                   </tbody>
               </table>
           </div>
           <div class="card-footer"></div>
       </div>

   </div>
    


  <!-- Bootstrap core JavaScript -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.js"></script>
  <script src="assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>
