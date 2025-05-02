<?php
session_start(); /* starting the session for this page */

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){/* if the user is not loged in */
    header("location: login.php");                                 /* send the user back to the login page */
    exit;
}
$atPosition = strpos($_SESSION['username'], '@');
/* <?php $_SESSION['username'] ?> */
/* <?php echo $_SESSION['username'] ?> */

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="imgs/icon_project.png">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
    <link rel="stylesheet" href="style3.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .card-img-top {
            width: 120px; 
            height: 120px; 
            object-fit: cover; 
        }
        .card-body {
            display: flex;
            align-items: center; 
        }
        .text-content {
            margin-left: 10px; 
        }
        .dropdown-menu {
            z-index: 3; 
        }
    </style>
    <title>Online Printing Service | Custom Printing Done</title>
</head>
<body>
    <!-- header of this page -->
    <div class="header">
    <a href="welcome.php"><img src="imgs/icon_project.png" alt="Project Icon" style="width: 150px; height: 90px;padding-top: 0px;padding-bottom:20px;"></a>
        <div class="orders1" style="display:flex; padding-top:10px;">
            <div class=" my-3">
                <div class="d-flex align-items-center">
                    <a href="Cap_log.php" style="color: #000; text-decoration: none; margin-right: 15px;padding-right:5px;">Capabilities</a>
            
                    <!-- First Dropdown -->
                    <div class="dropdown me-2">
                        <a href="#" class="dropdown-toggle" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false" style="color: black; text-decoration: none; padding-right:5px;">
                            Support
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                            <li><a class="dropdown-item" href="#">Help Center</a></li>
                            <li><a class="dropdown-item" href="#">Q&A</a></li>
                            <li><a class="dropdown-item" href="#">Blogs</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Tools</a></li>
                        </ul>
                    </div>
            <!-- Second Dropdown -->
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" role="button" id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="false" style="color: black; text-decoration: none; padding-right:5px;">
                            Types
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                            <li>
                                <div class="container1">
                                    <div class="row-10">
                                        <div class="col-10">
                                            <div class="card mx-2 my-2" style="width: 500px;">
                                                <div class="card-body d-flex" style="width: 500px;" >
                                                    <img src="imgs/Screenshot 2024-09-26 134737.png" class="card-img-top" alt="Support Image 1">
                                                    <div class="text-content">
                                                        <h5 class="card-title">Documents</h5>
                                                        <p class="card-text">Online Document Printing by Printster.in, Printing with us is Easy.</p>
                                                        <a href="#" class="btn btn-primary btn-sm">Learn More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <div class="card mx-2 my-2" style="width: 500px;">
                                                <div class="card-body d-flex" style="width: 500px;">
                                                    <img src="imgs/Screenshot 2024-09-26 134755.png" class="card-img-top" alt="Support Image 2">
                                                    <div class="text-content">
                                                        <h5 class="card-title">Books</h5>
                                                        <p class="card-text">Your source for top quality custom printed books, Hardcover or paperback book using a wide range of paper, color, and binding options.</p>
                                                        <a href="#" class="btn btn-primary btn-sm">Learn More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <div class="card mx-2 my-2" style="width: 500px;">
                                                <div class="card-body d-flex" style="width: 500px;">
                                                    <img src="imgs/Screenshot 2024-09-26 134812.png" class="card-img-top" alt="Support Image 3">
                                                    <div class="text-content">
                                                        <h5 class="card-title">Poster Making</h5>
                                                        <p class="card-text">Poster printing is available in a variety of sizes and lets you take advantage of almost any open space.</p>
                                                        <a href="#" class="btn btn-primary btn-sm">Learn More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                <a href="Aboutus_loggedin.php" style="color: #000; text-decoration: none; margin-right: 15px;padding-left:5px;">About Us</a>
            </div>
        </div>
    </div> 
    <div class="orders" style="padding-left: 450px; padding-top: 30px;">
            <a href="test.php" class="a" style="color: #000;text-decoration: none; margin-left:20px;">Orders</a>
            <a href="" style="color: #000;text-decoration: none; margin-left:20px;">My File</a>
            <a href="" style="color: #000;text-decoration: none; margin-left:20px;"><?php echo substr($_SESSION['username'], 0, $atPosition);  ?></a>
            <a href="logout.php" id="contact" style="color: #000;text-decoration: none; margin-left:20px;">Logout</a>
        </div>
    </div>

    <!-- slider images -->
    <div class="b">
    <div class="scr1" style="padding-top:15px;">
            <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner" >
                <div class="carousel-item active" style="height:460px;">
                <img src="imgs/Screenshot 2024-09-13 141630.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
                </div>
                <div class="carousel-item" style="height:460px;">
                <img src="imgs/Screenshot 2024-09-13 141630.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Some representative placeholder content for the second slide.</p>
                </div>
                </div>
                <div class="carousel-item" style="height:460px;">
                <img src="imgs/Screenshot 2024-09-13 141630.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide label</h5>
                    <p>Some representative placeholder content for the third slide.</p>
                </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            </div>
            </div>
            <!-- cards for showing information -->
            <p class="para">TRY THIS!!!!</p>
        <div class="container" style="padding-bottom:40px;">
            <div class="cards" style="padding-bottom:40px;">
                <img src="https://images.unsplash.com/photo-1521791055366-0d553872125f?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8ZG9jdW1lbnR8ZW58MHx8MHx8fDA%3D">
                <div id="btns">
                    <p>Documents</p>
                    <tr>
                        <li>We Use A4 sheet for this type of printing</li>
                        <li>only black and white print</li>
                        <li>sheet thickness is 0.06 mm</li>
                        <li>minimum 20 sheets </li>
                        <li>maximum 1000 sheets</li>
                    </tr>
                </div>
            </div>
            <div class="cards">
                <img src="https://images.unsplash.com/photo-1521791055366-0d553872125f?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8ZG9jdW1lbnR8ZW58MHx8MHx8fDA%3D">
                <div id="btns">
                    <p>Documents</p>
                    <tr>
                        <li>We Use A4 sheet for this type of printing</li>
                        <li>only black and white print</li>
                        <li>sheet thickness is 0.06 mm</li>
                        <li>minimum 20 sheets </li>
                        <li>maximum 1000 sheets</li>
                    </tr>
                </div>
            </div>
        </div>
        <!-- more picture can be replaced by video-->
        <div class="demo">
            <div class="pic">
                <img src="imgs/Screenshot 2024-09-13 151834.png">
            </div>
            <div class="dis">
                <ul>
                    <li><h3>How it works</h3></li>
                    <li>
                        <B>Upload the file</B>
                        <p>Upload your file online and select materials to get an instant quote, price starts from &#x20b9;40.00</p>
                    </li>
                    <li>
                        <B>Printing</B>
                        <p>Our industrial printers and professional operators will Print your documents with the highest quality.</p>
                    </li>
                    <li>
                        <B>Delivery straight to you</B>
                        <p>Printzer printing service covers a worldwide delivery, we will ship to your doors directly from our printing factory.</p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="scr">
            <img src="imgs/bg.png" alt="Image 2" class="moving-image">
        </div>
        <!-- customer reviews -->
        <h3 class="h">What Our Customers Say</h3>
        <div class="information">
            <div class="cardss">
                <i class="fa fa-bookmark"></i>
                <p>Printzer printing service allows me to use modern and advancedprinting technologies that I couldn't use otherwise as a hobbyist to get books at a good price. The pricing is affordable.</p>
                <p>gaurav</p>
                <p>software eng</p>
            </div>
            <div class="cardss">
                <i class="fa fa-bookmark"></i>
                <p>Printzer printing service allows me to use modern and advancedprinting technologies that I couldn't use otherwise as a hobbyist to get books at a good price. The pricing is affordable.</p>
                <p>gaurav</p>
                <p>software eng</p>
            </div>
            <div class="cardss">
                <i class="fa fa-bookmark"></i>
                <p>Printzer printing service allows me to use modern and advancedprinting technologies that I couldn't use otherwise as a hobbyist to get books at a good price. The pricing is affordable.</p>
                <p>gaurav</p>
                <p>software eng</p>
            </div>
            <div class="cardss">
                <i class="fa fa-bookmark"></i>
                <p>Printzer printing service allows me to use modern and advancedprinting technologies that I couldn't use otherwise as a hobbyist to get books at a good price. The pricing is affordable.</p>
                <p>gaurav</p>
                <p>software eng</p>
            </div>
        </div>
    </div>
    <!-- footer of this page -->
    <div class="footer">
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
                2024  &copy; Copyright <strong><span>@Printzer</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <a href="">Webdev@Printzer</a>
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