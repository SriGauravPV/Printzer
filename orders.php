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

/* sending information to the database */
if (isset($_POST["submit"])) {
    $type = mysqli_real_escape_string($conn, $_POST["type"]);
    $size = mysqli_real_escape_string($conn, $_POST["size"]);
    $borders = mysqli_real_escape_string($conn, $_POST["borders"]);
    $type_print = mysqli_real_escape_string($conn, $_POST["type_print"]);
    $Qty = mysqli_real_escape_string($conn, $_POST["Qty"]);
    $prod = mysqli_real_escape_string($conn, $_POST["prod"]);
    $Package_type = mysqli_real_escape_string($conn, $_POST["Package_type"]);
    $no_sheet = mysqli_real_escape_string($conn, $_POST["no_sheet"]);
    if (isset($_SESSION['username'])) {
        // Sanitize the session username
        $email = mysqli_real_escape_string($conn, $_SESSION['username']);
    
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
    /* values insertion to the database */
    $query = "INSERT INTO `printzer`.`information` (`type`,`email`,`filename`, `size`, `borders`, `type_print`, `Qty`, `prod`, `Package_type`, `no_sheet`) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)";

    $stmt = mysqli_prepare($conn, $query);
    if (!$stmt) {
        die("MySQL Prepare failed: " . mysqli_error($conn)); 
    }
    mysqli_stmt_bind_param($stmt, 'ssssssssss', $type,$email,$filename, $size, $borders, $type_print, $Qty, $prod, $Package_type, $no_sheet);

    /* insertion is success or not */
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Data Inserted Successfully');</script>";
    } else {
        echo "<script>alert('Data Insertion Failed');</script>";
    }

    /* closing the connection */
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="imgs/icon_project.png"> 
    <link rel="stylesheet" href="style.css">
     <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Order Page | Online Printing Service</title>
    <style>
    .btn-check {
        display: none;
    }

    .btn {
        border: 1px solid #000;
        /* background:url(/shop-cart-static/img/gou-blue-small.88d403e.svg) 100% 100% no-repeat #f7fbff!important; */
        padding: 5px;
        border-radius: 5px;
        cursor: pointer;
        margin-right:5px;
    }

    .btn-check:checked + .btn {
        background-color: #f0f0f0;
        border:2px solid rgb(185, 235, 235);
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

    <!-- selection process for the requirement -->
    <div class="container">
    <div class="select">
        <div class="category" style="margin-top:18px">
            <form action="" method="post"  enctype="multipart/form-data" autocomplete="off">
                <div class="types">
                    <input type="radio" name="type" class="btn-check selectable"  value="white sheet" id="btn-check-4" autocomplete="off">
                    <label class="btn" for="btn-check-4">White Sheet</label>

                    <input type="radio" name="type" class="btn-check selectable" value="brown sheet" id="btn-check-5" autocomplete="off">
                    <label class="btn" for="btn-check-5">Brown Sheet</label>

                    <input type="radio" name="type" class="btn-check selectable" value="hard paper" id="btn-check-6" autocomplete="off">
                    <label class="btn" for="btn-check-6">Hard Paper</label>

                    <input type="radio" name="type" class="btn-check selectable" value="card board" id="btn-check-7" autocomplete="off">
                    <label class="btn" for="btn-check-7">Card Board</label>
                </div>
                <!-- file uploading -->
                <div class="upload">
                    <input type="file" id="myFile" name="choosefile">
                    <label>Only accept zip or rar, Max 50 MB. All uploads are secure and confidential.</label>
                </div>
                <!-- selections from the options given below -->
                <div class="ap1">
                    <label style="margin:5px; padding-right: 10px; width:150px;justify-content: space-between;">Size</label>
                    <input type="radio" name="size" class="btn-check b1" value="A5" id="btn-check-8" autocomplete="off">
                    <label class="btn" for="btn-check-8">A5</label>

                    <input type="radio" name="size" class="btn-check b1" value="A4" id="btn-check-9" autocomplete="off">
                    <label class="btn" for="btn-check-9">A4</label>

                    <input type="radio" name="size" class="btn-check b1" value="A3" id="btn-check-10" autocomplete="off">
                    <label class="btn" for="btn-check-10">A3</label>

                    <input type="radio" name="size" class="btn-check b1" value="A2" id="btn-check-11" autocomplete="off">
                    <label class="btn" for="btn-check-11">A2</label>

                    <input type="radio" name="size" class="btn-check b1" value="A1" id="btn-check-12" autocomplete="off">
                    <label class="btn" for="btn-check-12">A1</label>
                </div>

                <div class="ap2">
                    <label style="margin:5px; padding-right: 10px; width:150px;justify-content: space-between;" >Border:</label>
                    <input type="radio" name="borders" class="btn-check b2" value="Yes" id="btn-check-13" autocomplete="off">
                    <label class="btn" for="btn-check-13">Yes</label>

                    <input type="radio" name="borders" class="btn-check b2" value="No" id="btn-check-14" autocomplete="off">
                    <label class="btn" for="btn-check-14">No</label>
                </div>

                <div class="ap3">
                    <label style="margin:5px; padding-right: 10px; width:150px;justify-content: space-between;">Type Of Print</label>
                    <input type="radio" name="type_print" class="btn-check b3" value="Color_Print" id="btn-check-15" autocomplete="off">
                    <label class="btn" for="btn-check-15">Color Print</label>

                    <input type="radio" name="type_print" class="btn-check b3" value="Black_and_White_Print" id="btn-check-16" autocomplete="off">
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
                    <input type="number" class="i3" name="no_sheet" required>
                </div>

                <button type="submit" name="submit" id="button-submit">Get Quotation</button>
            </form>
        </div>

        <!-- basic information -->
        <div class="calculated-price">
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
    </div>
    </div>
    <!-- footer of the website -->
    <div class="footer1">
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

</body>
</html>
