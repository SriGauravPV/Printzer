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
    $type=$_POST['type'];
    $size=$_POST['size'];
    $types=$_POST['types'];
    $borders=$_POST['borders'];
    $type_print=$_POST['type_print'];
    $Qty=$_POST['Qty'];
    $prod=$_POST['prod'];
    $Package_type=$_POST['Package_type'];
    $no_sheet=$_POST['no_sheet'];
    $Print_Quality=$_POST['Print_Quality'];
    $h_f=$_POST['h_f'];
    $Print_Resolution=$_POST['Print_Resolution'];
    $Finishing_Options=$_POST['Finishing_Options'];
    $Ink_Usage=$_POST['Ink_Usage'];
    $Color_Management=$_POST['Color_Management'];
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
    $sql="INSERT INTO `orders` (`username`,`type`,`filename`,`size`,`types`,`borders`,`type_print`,`Qty`,`prod`,`Package_type`,`no_sheet`,`Print_Quality`,`h_f`,`Print_Resolution`,`Finishing_Options`,`Ink_Usage`,`Color_Management`) 
    VALUES('$username','$type','$filename','$size','$types','$borders','$type_print','$Qty','$prod','$Package_type','$no_sheet','$Print_Quality','$h_f','$Print_Resolution','$Finishing_Options','$Ink_Usage','$Color_Management')";
    $result=mysqli_query($conn,$sql);
    if($result){
        $insert=true;
    }else{
        echo mysqli_error($conn);
    }
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Data Inserted Successfully');</script>";
    } else {
        echo "<script>alert('Data Insertion Failed');</script>";
    }
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
            <a href="test.php" class="a" style="color: #000;text-decoration: none; margin-left:300px;">Orders</a>
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
                        <input type="radio" name="type" class="btn-check selectable"  value="board printing" id="btn-check-4" autocomplete="off" disabled>
                        <label class="btn" for="btn-check-4" style="margin-right:5px; padding:7px; width:11pc;">board printing</label>

                        <input type="radio" name="type" class="btn-check selectable" value="brown sheet" id="btn-check-5" autocomplete="off" disabled>
                        <label class="btn" for="btn-check-5" style="margin-right:5px; padding:7px;width:11pc;">3d Printing</label>

                        <input type="radio" name="type" class="btn-check selectable" value="hard paper" id="btn-check-6" autocomplete="off" disabled>
                        <label class="btn" for="btn-check-6" style="margin-right:5px; padding:7px;width:11pc;">Tshirt Printing</label>

                        <input type="radio" name="type" class="btn-check selectable" value="card board" id="btn-check-7" autocomplete="off">
                        <label class="btn" for="btn-check-7" style="margin-right:5px; padding:7px;width:11pc; border:2px solid rgb(78, 81, 250);">Equipment Printing</label>

                        <input type="radio" name="type" class="btn-check selectable" value="hard paper" id="btn-check-19" autocomplete="off" disabled>
                        <label class="btn" for="btn-check-19" style="margin-right:5px; padding:7px;width:11pc;">Book</label>

                        <input type="radio" name="type" class="btn-check selectable" value="hard paper" id="btn-check-20" autocomplete="off" disabled>
                        <label class="btn" for="btn-check-20" style="margin-right:5px; padding:7px;width:11pc;">Lazer Printing</label>
                    </div>
                <!-- file uploading -->
                    <div class="upload">
                        <input type="file" id="myFile" name="choosefile">
                        <label>Only accept zip or rar or pdfs, Max 2 MB. All uploads are secure and confidential.</label>
                    </div>
                <!-- selections from the options given below -->
                    <div class="ap1">
                        <label style="margin:5px; padding-right: 10px; width:150px;">Size</label>
                        <input type="radio" name="size" class="btn-check b1" value="A5" id="btn-check-8" autocomplete="off" disabled>
                        <label class="btn" for="btn-check-8">A5</label>

                        <input type="radio" name="size" class="btn-check b1" value="A4" id="btn-check-9" autocomplete="off" disabled>
                        <label class="btn" for="btn-check-9">A4</label>

                        <input type="radio" name="size" class="btn-check b1" value="A3" id="btn-check-10" autocomplete="off" disabled>
                        <label class="btn" for="btn-check-10">A3</label>

                        <input type="radio" name="size" class="btn-check b1" value="A2" id="btn-check-11" autocomplete="off" disabled>
                        <label class="btn" for="btn-check-11">A2</label>

                        <input type="radio" name="size" class="btn-check b1" value="A1" id="btn-check-12" autocomplete="off" disabled>
                        <label class="btn" for="btn-check-12">A1</label>
                    </div>
                    <div class="ap1">
                        <label style="margin:5px; padding-right: 10px; width:150px;">Sheet type</label>
                        <input type="radio" name="types" class="btn-check b1" value="White Sheet" id="btn-check-21" autocomplete="off" disabled>
                        <label class="btn" for="btn-check-21">White Sheet</label>

                        <input type="radio" name="types" class="btn-check b1" value="Brown Sheet" id="btn-check-22" autocomplete="off" disabled>
                        <label class="btn" for="btn-check-22">Brown Sheet</label>

                        <input type="radio" name="types" class="btn-check b1" value="Craft Paper" id="btn-check-23" autocomplete="off" disabled>
                        <label class="btn" for="btn-check-23">Craft Paper</label>

                        <input type="radio" name="types" class="btn-check b1" value="Photo Paper" id="btn-check-24" autocomplete="off" disabled>
                        <label class="btn" for="btn-check-24">Photo Paper</label>

                        <input type="radio" name="types" class="btn-check b1" value="Ink Jet Paper" id="btn-check-25" autocomplete="off">
                        <label class="btn" for="btn-check-25">Ink Jet Paper</label>

                        <input type="radio" name="types" class="btn-check b1" value="Glossy Paper" id="btn-check-26" autocomplete="off">
                        <label class="btn" for="btn-check-26">Glossy Paper</label>

                        <input type="radio" name="types" class="btn-check b1" value="NewsPaper" id="btn-check-27" autocomplete="off" disabled>
                        <label class="btn" for="btn-check-27">NewsPaper</label>

                        <input type="radio" name="types" class="btn-check b1" value="Linen Paper" id="btn-check-28" autocomplete="off" disabled>
                        <label class="btn" for="btn-check-28">Linen Paper</label>
                    </div>

                    <div class="ap2">
                        <label style="margin:5px; padding-right: 10px; width:150px;justify-content: space-between;" >Border:</label>
                        <input type="radio" name="borders" class="btn-check b2" value="Yes" id="btn-check-13" autocomplete="off" disabled>
                        <label class="btn" for="btn-check-13">Yes</label>

                        <input type="radio" name="borders" class="btn-check b2" value="No" id="btn-check-14" autocomplete="off" disabled>
                        <label class="btn" for="btn-check-14">No</label>
                    </div>

                    <div class="ap3">
                        <label style="margin:5px; padding-right: 10px; width:150px;justify-content: space-between;">Type Of Print</label>
                        <input type="radio" name="type_print" class="btn-check b3" value="Color_Print" id="btn-check-15" autocomplete="off">
                        <label class="btn" for="btn-check-15">Color Print</label>

                        <input type="radio" name="type_print" class="btn-check b3" value="Black_and_White_Print" id="btn-check-16" autocomplete="off"disabled>
                        <label class="btn" for="btn-check-16">Black and White Print</label>
                    </div>

                    <div class="ap4">
                        <label style="margin:5px; padding-right: 10px; width:150px;justify-content: space-between;">Qty</label>
                        <input type="number" class="i1" name="Qty" required>
                    </div>

                    <div class="ap5">
                        <label style="margin:5px; padding-right: 10px; width:150px;justify-content: space-between;">Product Use</label>
                        <input type="text" class="i2" name="prod" required>
                    </div>

                    <div class="ap6">
                        <label style="margin:5px; padding-right: 10px; width:150px;justify-content: space-between;">Package Type</label>
                        <input type="radio" name="Package_type" class="btn-check b6" value="Box Packing" id="btn-check-17" autocomplete="off">
                        <label class="btn" for="btn-check-17">Box Packing</label>

                        <input type="radio" name="Package_type" class="btn-check b6" value="Normal Packing with PRINTZER logo" id="btn-check-18" autocomplete="off">
                        <label class="btn" for="btn-check-18">Normal Packing with PRINTZER logo</label>
                    </div>

                    <div class="ap7">
                        <label style="margin:5px; padding-right: 10px; width:150px;justify-content: space-between;">sheets present</label>
                        <input type="number" class="i3" name="no_sheet" disabled>
                    </div>
                    
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                        <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <h5 class="mb-0">
                            <span class="btn btn-link">
                            <b>Specifications</b>
                            </span>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="ap1">
                                    <label style="margin:5px; padding-right: 10px; width:130px;justify-content: space-between;">Print Quality</label>
                                    <input type="radio" name="Print_Quality" class="btn-check b1" value="High" id="btn-check-29" autocomplete="off">
                                    <label class="btn" for="btn-check-29">High</label>

                                    <input type="radio" name="Print_Quality" class="btn-check b1" value="Medium" id="btn-check-30" autocomplete="off" disabled>
                                    <label class="btn" for="btn-check-30">Medium</label>

                                    <input type="radio" name="Print_Quality" class="btn-check b1" value="A3" id="btn-check-31" autocomplete="off" disabled>
                                    <label class="btn" for="btn-check-31">Low</label>
                                </div>  
                                <div class="ap1">  
                                    <label style="margin:5px; padding-right: 10px; width:130px;justify-content: space-between;">Header/Footer</label>  
                                    <input type="radio" name="h_f" class="btn-check b1" value="include " id="btn-check-32" autocomplete="off" disabled>
                                    <label class="btn" for="btn-check-32">include </label>

                                    <input type="radio" name="h_f" class="btn-check b1" value="exclude " id="btn-check-33" autocomplete="off" disabled>
                                    <label class="btn" for="btn-check-33">exclude </label>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="card">
                        <div class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <h5 class="mb-0">
                            <span class="btn btn-link">
                           <b> High-spec Options</b>
                            </span>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="ap1">
                                    <label style="margin:5px; padding-right: 10px; width:130px;justify-content: space-between;">Print Resolution</label>
                                    <input type="radio" name="Print_Resolution" class="btn-check b1" value="High" id="btn-check-34" autocomplete="off" disabled>
                                    <label class="btn" for="btn-check-34">High</label>

                                    <input type="radio" name="Print_Resolution" class="btn-check b1" value="Medium" id="btn-check-35" autocomplete="off" disabled>
                                    <label class="btn" for="btn-check-35">Medium</label>

                                    <input type="radio" name="Print_Resolution" class="btn-check b1" value="A3" id="btn-check-36" autocomplete="off" disabled>
                                    <label class="btn" for="btn-check-36">Low</label>
                                </div>  
                                <div class="ap1">  
                                    <label style="margin:5px; padding-right: 10px; width:130px;justify-content: space-between;">Finishing:</label>  
                                    <input type="radio" name="Finishing_Options" class="btn-check b1" value="Binding" id="btn-check-37" autocomplete="off" disabled>
                                    <label class="btn" for="btn-check-37">Binding </label>

                                    <input type="radio" name="Finishing_Options" class="btn-check b1" value="Collation" id="btn-check-38" autocomplete="off" disabled>
                                    <label class="btn" for="btn-check-38">Collation </label>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="card">
                        <div class="card-header" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <h5 class="mb-0">
                            <span class="btn btn-link">
                            <b>Advanced Options</b>
                            </span>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="ap1">
                                    <label style="margin:5px; padding-right: 10px; width:130px;justify-content: space-between;">Ink Usage:</label>
                                    <input type="radio" name="Ink_Usage" class="btn-check b1" value="Draft Mode" id="btn-check-39" autocomplete="off">
                                    <label class="btn" for="btn-check-39">Draft Mode</label>

                                    <input type="radio" name="Ink_Usage" class="btn-check b1" value="Toner Save" id="btn-check-40" autocomplete="off">
                                    <label class="btn" for="btn-check-40">Toner Save</label>

                                    <input type="radio" name="Ink_Usage" class="btn-check b1" value="normal" id="btn-check-41" autocomplete="off">
                                    <label class="btn" for="btn-check-41">normal</label>
                                </div>  
                                <div class="ap1">  
                                    <label style="margin:5px; padding-right: 10px; width:130px;justify-content: space-between;">Color Management:</label>  
                                    <input type="radio" name="Color_Management" class="btn-check b1" value="CMYK " id="btn-check-42" autocomplete="off">
                                    <label class="btn" for="btn-check-42">CMYK  </label>

                                    <input type="radio" name="Color_Management" class="btn-check b1" value="RGB" id="btn-check-43" autocomplete="off">
                                    <label class="btn" for="btn-check-43">RGB </label>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <button class="my-4" type="submit" name="submit" id="button-submit">Get Quotation</button>
                </form>
            </div>
            </div>
            </div>
        <!-- basic information -->
            <!-- <div class="calculated-price " style="margin-top:70px; margin-right:30px;">
                <h2>Calculated Price</h2>
                <div class="charges">
                    <p>The approx price details will be sent through email</p>
                    <p class="c" id="cl">Total Cost will be mentioned</p>
                    <h4 id="cl1">you can go through it and send back an email </h4>
                    <p>Additional charges may apply for special cases</p>
                    <p>Any queries click the button below</p>
                    <a href=""><button id="main-button">Click Me </button></a>
                </div>
            </div>
        </div> -->
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
    const radioButton2 = document.getElementById('btn-check-6');

    // Add an event listener to detect when the radio button is clicked
    radioButton.addEventListener('change', function() {
        if (radioButton.checked) {
        // Redirect to another page
        window.location.href = "printing3d.php";
        }
    });
    radioButton2.addEventListener('change', function() {
        if (radioButton2.checked) {
        // Redirect to another page
        window.location.href = "shirt.php";
        }
    });
    document.getElementById("button-submit").addEventListener("click", function(event) {
        //check to see if the user is logged in
        var isLoggedIn = <?php echo isset($_SESSION['username']) ? 'true' : 'false'; ?>;

        if (!isLoggedIn) {
            event.preventDefault(); // Prevent form submission
            alert("Please log in first."); // Show alert
        }
    });
    </script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>