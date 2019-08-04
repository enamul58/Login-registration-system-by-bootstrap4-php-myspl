
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
        <a class="navbar-brand" href="#">Login Registration System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <?php if(isset($_SESSION['logIn'])){ ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php?id=<?php  echo $_SESSION['id'];?>">profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <?php if(isset( $_SESSION['userName'])){echo $_SESSION['userName'];} ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?logOut=true">Logout</a>
                </li>
             <?php }else{ ?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="registration.php">Registration</a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
