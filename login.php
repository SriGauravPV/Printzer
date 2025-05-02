<?php   
    /* connection to the database */
    include 'partials/_dbconnect.php';
    $loginCheck=false; /* checking if the user has logged in */
    $showError=false;

    /* checking if the user information is present in database */
    if($_SERVER['REQUEST_METHOD']=='POST'){
        
        $username=$_POST['username'];
        $password=$_POST['password'];
        $sql="select * from user_login where username='$username'"; /* username verification */
        $result=mysqli_query($conn,$sql);
        $num=mysqli_num_rows($result);
        if ($num == 1){
            while($row=mysqli_fetch_assoc($result)){
                $test=password_verify($password, $row['password']); /* password verification */
                if (password_verify($password, $row['password'])){ 
                    $login = true;
                    session_start();/* starting a new session */
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $username;
                    header("location: welcome.php"); /* transfering the user to the welcome page */
                } 
                else{
                    $showError="Invalid username or password";
                }
                
            }
        }
        else{
            $showError="Invalid username or password";
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
            <img src="imgs/log.png">
        </div>
        
        <div class="log container my-5">
        <?php 
        /* alerts for the user to know what going on  */
        if($loginCheck){
            echo"<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Success</strong> You are now logged in.
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>";
        }
        if($showError){
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>ERROR!!!</strong> $showError
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>";
        }        
        ?>
        <!-- login information retrival -->
            <h1>Sign in to Printzer</h1>
            <h5>Need new account? <a href="signup.php">Sign up</a> now</h5>
            <form action="/printzer/login.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username/Email ID</label>
                <input type="email" class="form-control" id="username" name="username" aria-describedby="emailHelp" >
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <!-- admin login -->
            <h5 class="my-5">If you are the admin of printzer? <a href="admin.php">Admin_Login</a> here</h5>
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