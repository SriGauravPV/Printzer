<?php   
     /* connection to the database */
    include 'partials/_dbconnect.php';
    $showAlert=false;
    $showError=false;
    /* taking the new users information and sending it to the database */
    if($_SERVER['REQUEST_METHOD']=='POST'){
        
        $username=$_POST['username'];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];
        $existsql="SELECT * from `user_login` WHERE username='$username'";
        $result=mysqli_query($conn,$existsql);
        $numExistRow=mysqli_num_rows($result);
        if($numExistRow>0){
            $showError="Username already exists";/* checking the username existance */
        }
        else{
            if(($password==$cpassword)){ /* checking the password is entered the same in both the cases */
                $hash=password_hash($password,PASSWORD_DEFAULT); /* hashing the password for security perpose */
                $sql="INSERT INTO `user_login` (`username`, `password`, `dt`) VALUES ('$username', '$hash', current_timestamp());";
                $result=mysqli_query($conn,$sql);
                if($result){
                    $showAlert=true;
                }
            }
            else{
                $showError="Password does not match";
            }
        }    
    }

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style2.css">
    <link rel="icon" href="imgs/icon_project.png">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Login | Online Printing Service</title>
  </head>
  <body>
    <div class="main">
        <div class="image">
            <img src="imgs/log.png" >
        </div>
        <!-- alerts for the user to know whats going on -->
        <div class="log container my-5">
        <?php 
            if($showAlert){
                echo"<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>Success</strong> You can now login as your account is now Created.
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>";
            }
            if($showError){
                echo"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>ERROR!!!</strong> '.$showError.'
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>";
            }
        ?>
        <!-- new account creation for user-->
            <h1>Create your account</h1>
            <h5>Already have an account?<a href="login.php">Log in</a> here</h5>
            <form action="/printzer/signup.php" method="post">
                <div class="form-group my-2">
                    <label for="username">Username/Email ID</label>
                    <input type="email" class="form-control" id="username" name="username" aria-describedby="emailHelp" >
                </div>
                <div class="form-group my-2">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name=password>
                </div>
                <div class="form-group my-2">
                    <label for="cpassword">Confirm Password</label>
                    <input type="password" class="form-control" id="cpassword" name=cpassword>
                    <small id="emailHelp" class="form-text text-muted">Make sure to type the same password</small>
                </div>
                <button type="submit" class="btn btn-primary my-2">SignUp</button>
            </form>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>