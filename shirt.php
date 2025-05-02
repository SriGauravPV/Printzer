<?php
session_start();/* starting the session for this page */

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){/* if the user is not loged in */
    header("location: login.php");                                  /* send the user back to the login page */
    exit;
}
$atPosition = strpos($_SESSION['username'], '@');
/* <?php $_SESSION['username'] ?> */
/* <?php echo $_SESSION['username'] ?> */

?>
<?php
/* connection with the database */
include 'partials/_dbconnect.php';

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if($_SERVER['REQUEST_METHOD']=='POST'){
    if (isset($_POST["submit"])) {
    $size=$_POST['Size'];
    $Design=$_POST['Design'];
    $Orientation=$_POST['Orientation'];
    $sleeves=$_POST['sleeves'];
    $Qty=$_POST['Qty'];
    $Product_Use=$_POST['Product_Use'];
    $Build_Time=$_POST['Build_Time'];
    $Package_Desc=$_POST['Package_Desc'];
    if (isset($_SESSION['username'])) {
        // Sanitize the session username
        $username = mysqli_real_escape_string($conn, $_SESSION['username']);
    
    } else {
        // Handle the case when the user is not logged in
        echo "User is not logged in.";
    }
    if (isset($_FILES["choosefile"]) && $_FILES["choosefile"]["error"] == 0) {
        /* sending file information to the database */
        $filename = $_FILES["choosefile"]["name"];
        $tempfile = $_FILES["choosefile"]["tmp_name"];
        $folder = "image/" . $filename;
        if (move_uploaded_file($tempfile, $folder)) {
        } else {
            echo "<script>alert('File upload failed');</script>";
        }
    } else {
        $filename = ''; 
    }
    $sql="INSERT INTO `shirt` (`username`,`filename`,`size`,`Design`,`Orientation`,`sleeves`,`Qty`,`Product_Use`,`Build_Time`,`Package_Desc`) 
    VALUES('$username','$filename','$size','$Design','$Orientation','$sleeves','$Qty','$Product_Use','$Build_Time','$Package_Desc')";
    $result=mysqli_query($conn,$sql);
    if($result){
        echo "<script>alert('Data Inserted Successfully');</script>";
        $insert=true;
    }else{
        echo mysqli_error($conn);
    }
    /* if (mysqli_stmt_execute($result)) {
        echo "<script>alert('Data Inserted Successfully');</script>";
    } else {
        echo "<script>alert('Data Insertion Failed');</script>";
    } */
}
}
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="icon" href="imgs/icon_project.png"> 
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <title>Order Page | Online Printing Service</title>
    <style>
        .btn-link {
            background: none;  
            border: none;      
            padding: 0;       
            color: inherit;   
            text-decoration: none; 
            cursor: pointer; 
        }
        .card-header {
            cursor: pointer; 
            padding: 10px;  
            min-height: 50px;
        }
        .btn-link:hover {
            color: #007bff;  
        }
    </style>
  </head>
  <body>
    <!-- header of the webpage -->
    <div class="header" style="margin-bottom:30px;">
        <a href="welcome.php"><img src="imgs/icon_project.png" alt="Project Icon" style="width: 150px; height: 90px;padding-top: 0px;padding-bottom:20px;"></a>
        <div class="dropdows"></div>
        <div class="orders">
            <a href="orders.php" class="a" style="color: #000;text-decoration: none; margin-left:300px;">Orders</a>
            <a href="" style="color: #000;text-decoration: none; margin-left:20px;">My File</a>
            <a href="" style="color: #000;text-decoration: none; margin-left:20px;"><?php echo substr($_SESSION['username'], 0, $atPosition);  ?></a>
            <a href="logout.php" id="contact" style="color: #000;text-decoration: none; margin-left:20px;">Logout</a>
        </div>
        <div class="cartt" style="padding-top:13px;">
            <i class="fa fa-cart-plus" style="margin-top:0px; padding-top:0px;box-sizing:"></i>
        </div>
    </div>
    <div class="container" style="margin-left:100px;">
        <div class="select">
            <div class="category" style="margin-top:18px">
                <form action="" method="post"  enctype="multipart/form-data" autocomplete="off">
                    <div class="types">
                        <input type="radio" name="type" class="btn-check selectable"  value="board printing" id="btn-check-4" autocomplete="off" disabled >
                        <label class="btn" for="btn-check-4" style="margin-right:5px; padding:7px; width:11pc;">board printing</label>

                        <input type="radio" name="type" class="btn-check selectable" value="brown sheet" id="btn-check-5" autocomplete="off" disabled>
                        <label class="btn" for="btn-check-5" style="margin-right:5px; padding:7px;width:11pc;">3d Printing</label>

                        <input type="radio" name="type" class="btn-check selectable" value="hard paper" id="btn-check-6" autocomplete="off">
                        <label class="btn" for="btn-check-6" style="margin-right:5px; padding:7px;width:11pc;border:2px solid rgb(78, 81, 250);">Tshirt Printing</label>

                        <input type="radio" name="type" class="btn-check selectable" value="card board" id="btn-check-7" autocomplete="off" disabled>
                        <label class="btn" for="btn-check-7" style="margin-right:5px; padding:7px;width:11pc;">Equipment Printing</label>

                        <input type="radio" name="type" class="btn-check selectable" value="hard paper" id="btn-check-19" autocomplete="off" disabled>
                        <label class="btn" for="btn-check-19" style="margin-right:5px; padding:7px;width:11pc;">Book</label>

                        <input type="radio" name="type" class="btn-check selectable" value="hard paper" id="btn-check-20" autocomplete="off" disabled>
                        <label class="btn" for="btn-check-20" style="margin-right:5px; padding:7px;width:11pc;">Lazer Printing</label>
                    </div>
                <!-- file uploading -->
                    <div class="upload">
                        <input type="file" id="myFile" name="choosefile">
                        <label>Add 3D File.Only accept zip or rar or pdfs, Max 2 MB. All uploads are secure and confidential.</label>
                    </div>
                <!-- selections from the options given below -->
                    <div class="ap1">
                        <label style="margin:5px; padding-right: 10px; width:150px;">Size </label>
                        <input type="radio" name="Size" class="btn-check b1" value="SLA " id="btn-check-8" autocomplete="off" >
                        <label class="btn" for="btn-check-8">S </label>

                        <input type="radio" name="Size" class="btn-check b1" value="MJF" id="btn-check-9" autocomplete="off">
                        <label class="btn" for="btn-check-9">M</label>

                        <input type="radio" name="Size" class="btn-check b1" value="SLM" id="btn-check-10" autocomplete="off">
                        <label class="btn" for="btn-check-10">L</label>

                        <input type="radio" name="Size" class="btn-check b1" value="FDM" id="btn-check-11" autocomplete="off">
                        <label class="btn" for="btn-check-11">XL</label>

                        <input type="radio" name="Size" class="btn-check b1" value="SLS" id="btn-check-12" autocomplete="off">
                        <label class="btn" for="btn-check-12">XXL</label>
                    </div>
                    <div class="ap1">
                        <label style="margin:5px; padding-right: 10px; width:150px;">Design details </label>
                        <input type="radio" name="Design" class="btn-check b1" value="custom logo" id="btn-check-21" autocomplete="off" >
                        <label class="btn" for="btn-check-21">custom logo</label>

                        <input type="radio" name="Design" class="btn-check b1" value="custom text" id="btn-check-22" autocomplete="off">
                        <label class="btn" for="btn-check-22">custom text</label>

                        <input type="radio" name="Design" class="btn-check b1" value="Custom Images" id="btn-check-23" autocomplete="off">
                        <label class="btn" for="btn-check-23">Custom Images</label>

                        <input type="radio" name="Design" class="btn-check b1" value="Patterns" id="btn-check-24" autocomplete="off">
                        <label class="btn" for="btn-check-24">Patterns</label>

                        <input type="radio" name="Design" class="btn-check b1" value="Glitter effects" id="btn-check-25" autocomplete="off">
                        <label class="btn" for="btn-check-25">Glitter effects</label>

                        <input type="radio" name="Design" class="btn-check b1" value="metallic effects" id="btn-check-26" autocomplete="off">
                        <label class="btn" for="btn-check-26">metallic effects</label>

                        <input type="radio" name="Design" class="btn-check b1" value="NewsPaper" id="btn-check-27" autocomplete="off">
                        <label class="btn" for="btn-check-27">CBY Resin</label>

                        
                    </div>

                    <div class="ap2">
                        <label style="margin:5px; padding-right: 10px; width:150px;justify-content: space-between;" >Orientation:</label>
                        <input type="radio" name="Orientation" class="btn-check b2" value="Rotating " id="btn-check-13" autocomplete="off">
                        <label class="btn" for="btn-check-13">Rotating </label>

                        <input type="radio" name="Orientation" class="btn-check b2" value="flipping " id="btn-check-14" autocomplete="off">
                        <label class="btn" for="btn-check-14">flipping </label>
                    </div>

                    <div class="ap3">
                        <label style="margin:5px; padding-right: 10px; width:150px;justify-content: space-between;">sleeves</label>
                        <input type="radio" name="sleeves" class="btn-check b3" value="Full" id="btn-check-15" autocomplete="off">
                        <label class="btn" for="btn-check-15">Full</label>

                        <input type="radio" name="sleeves" class="btn-check b3" value="Half" id="btn-check-16" autocomplete="off">
                        <label class="btn" for="btn-check-16">Half</label>

                        <input type="radio" name="sleeves" class="btn-check b1" value="No sleeve" id="btn-check-28" autocomplete="off">
                        <label class="btn" for="btn-check-28">No sleeve</label>
                    </div>

                    <div class="ap4">
                        <label style="margin:5px; padding-right: 10px; width:150px;justify-content: space-between;">Qty</label>
                        <input type="number" class="i1" name="Qty" required>
                    </div>

                    <div class="ap5">
                        <label style="margin:5px; padding-right: 10px; width:150px;justify-content: space-between;">Product Use</label>
                        <input type="text" class="i2" name="Product_Use" required>
                    </div>

                    <div class="ap6">
                        <label style="margin:5px; padding-right: 10px; width:150px;justify-content: space-between;">Build Time</label>
                        <input type="radio" name="Build_Time" class="btn-check b6" value="6 hrs" id="btn-check-17" autocomplete="off">
                        <label class="btn" for="btn-check-17">6 hrs</label>

                        <input type="radio" name="Build_Time" class="btn-check b6" value="48 hrs" id="btn-check-18" autocomplete="off">
                        <label class="btn" for="btn-check-18">48 hrs</label>
                    </div>

                    <div class="ap7">
                        <label style="margin:5px; padding-right: 10px; width:150px;justify-content: space-between;">Package Desc</label>
                        <input type="text" class="i3" name="Package_Desc" required>
                    </div>
                    <button class="my-4" type="submit" name="submit" id="button-submit">Get Quotation</button>
                </form>
            </div>
            </div>
            </div>
    <!-- footer of the website -->
    <div class="footer1" style="width:100%; background-color:#505152;">
        <div class="foot">
            <div class="more">
                <ul>
                    <li><b>COMPANY</b></li>
                    <li><a href="" class="u">About us</a></li>
                    <li><a href="">News</a></li>
                    <li><a href="">Blogs</a></li>
                </ul>
                <ul>
                    <li><b>SUPPORT</b></li>
                    <li><a href="" class="u">Guide</a></li>
                    <li><a href="">Help Center</a></li>
                    <li><a href="">Contact us</a></li>
                </ul>
                <ul>
                    <li><b>NETWORK SITES</b></li>
                    <li><a href=""class="u">1</a></li>
                    <li><a href="">2</a></li>
                    <li><a href="">3</a></li>
                </ul>
            </div>
            <div class="copyright">
                2024  &copy; Copyright <strong><span>@ Sri Gaurav P V</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <a href="">Webdev@Sri Gaurav P V</a>
                <h3>Connect with us</h3>
            </div>
        </div>
        <div class="links">
            <a href=""><i class="fa fa-instagram"></i></a>
            <a href=""><i class="fa fa-linkedin"></i></a>
            <a href=""><i class="fa fa-facebook-square"></i></a>
            <a href=""><i class="fa fa-volume-control-phone"></i></a>
            <a href=""><i class="fa fa-twitter"></i></a>
            <a href=""><i class="fa fa-youtube-play"></i></a>
        </div>
    </div>
    <!-- <script src="app.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
    document.getElementById("button-submit").addEventListener("click", function(event) {
        //check to see if the user is logged in
        var isLoggedIn = <?php echo isset($_SESSION['username']) ? 'true' : 'false'; ?>;

        if (!isLoggedIn) {
            event.preventDefault(); // Prevent form submission
            alert("Please log in first."); // Show alert
        }
    });
    </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script>
    // Get the radio button element
    const radioButton = document.getElementById('btn-check-5');

    // Add an event listener to detect when the radio button is clicked
    radioButton.addEventListener('change', function() {
        if (radioButton.checked) {
        // Redirect to another page
        window.location.href = "printing3d.php";
        }
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>