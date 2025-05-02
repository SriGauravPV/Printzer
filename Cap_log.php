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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="imgs/icon_project.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style3.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="style.css">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Capabilities | Online Printing Service</title>
</head>
<body>
    <!-- header -->
    <div class="header">
    <a href="welcome.php"><img src="imgs/icon_project.png" alt="Project Icon" style="width: 150px; height: 90px;padding-top: 0px;padding-bottom:20px;"></a>
        <div class="orders1" style="display:flex; padding-top:10px;">
            <div class=" my-3">
                <div class="d-flex align-items-center">
                <a href="Cap_log.php" style="color: #000; text-decoration: none; margin-right: 15px;padding-right:5px;">Capabilities</a>
                <a href="aboutus_loggedin.php" style="color: #000; text-decoration: none; margin-right: 15px;padding-left:5px;">About Us</a>
            </div>
        </div>
    </div> 
    <div class="orders" style="padding-left: 450px; padding-top: 30px;">
            <a href="orders.php" class="a" style="color: #000;text-decoration: none; margin-left:70px;">Orders</a>
            <a href="" style="color: #000;text-decoration: none; margin-left:20px;">My File</a>
            <a href="" style="color: #000;text-decoration: none; margin-left:20px;"><?php echo substr($_SESSION['username'], 0, $atPosition);  ?></a>
            <a href="logout.php" id="contact" style="color: #000;text-decoration: none; margin-left:20px;">Logout</a>
            <a href="#"  style="color: #000;text-decoration: none; margin-left:10px;" data-toggle="modal" data-target="#exampleModal">Contact</a>
            <!-- Modal for the contact-->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Contact</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 style="margin-bottom:20px;">Any Queries you can contact us by</h4>
                    <p>Email: xyz@printzer.com</p>
                    <p>Phone: +91 9898989898</p>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- information reguarding the company -->
    <div class="card bg-dark text-white my-5">
        <img class="card-img" src="imgs/Screenshot 2024-09-26 115018.png" alt="Card image">
        <div class="card-img-overlay">
            <h1 class="card-title">PRINTZER</h1>
            <h4 class="card-text">We specialize in high-quality printing services tailored</h4>
            <h4 class="card-text"> to meet the needs of businesses and individuals alike.</h4>
            <p class="card-text">Last updated 3 mins ago</p>
        </div>
    </div>
    <!-- 3 links to get the capabilities of the company -->
    <div class="card text-center" style="margin:90px;">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#" onclick="activateTab(event, 'content1')">Tab 1</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="activateTab(event, 'content2')">Tab 2</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="activateTab(event, 'content3')">Tab 3</a>
            </li>
        </ul>
    </div>
    <!-- initial contant on the tab1 -->
    <div class="card-body" id="cardContent">
        <div class="container">  
            <div class="accordion" id="accordionExample">
                <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Group1
                    </button>
                    </h5>
                </div>
            
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                    1. Purpose and Audience:
                    Purpose: The website serves as an online platform for users to order printing services for various materials such as business cards, brochures, flyers, posters, and more.
                    Target Audience: Businesses (small to large), event planners, marketers, designers, and individuals seeking custom printing solutions.
                </div>
                </div>
                </div>
                <div class="card">
                <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Group2
                    </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body">
                    2. Services Offered:

                    Custom Printing: Options for personalized items like business cards, stationery, invitations, and promotional materials.
                    Design Services: Tools or services for creating or uploading designs, including templates for ease of use.
                    Wide Format Printing: Services for large posters, banners, and signs.
                    Digital Printing: Quick turnaround for short runs and high-quality prints.
                    Offset Printing: For larger quantities, providing cost-effectiveness with high-quality results.
                    Specialty Printing: Options like foil stamping, embossing, or die-cutting.</div>
                </div>
                </div>
                <div class="card">
                <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Group3
                    </button>
                    </h5>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body">
                    3. Features of the Website:
                    User-Friendly Interface: Easy navigation with clear categories for different types of printing services.
                    Design Tool: An online editor that allows users to create or customize their designs directly on the website.
                    Sample Gallery: Showcase previous work to demonstrate quality and inspire potential customers.
                    Pricing Calculator: Instant quotes based on size, quantity, and printing options.
                    Order Tracking: A system for customers to check the status of their orders.
                    Customer Support: Live chat, email, or phone support for assistance.
                    Blog/Resources: Articles on printing tips, design ideas, and industry news to engage visitors and improve SEO.
                </div>
                </div>
                </div>
            </div>
            </div>
    </div>
    </div>
    <!-- website footer -->
    <div class="footer">
        <div class="foot">
            <div class="more">
                <ul>
                    <li><b>COMPANY</b></li>              <!--  information reguarding the company -->
                    <li><a href="" class="u">About us</a></li>
                    <li><a href="">News</a></li>
                    <li><a href="">Blogs</a></li>
                </ul>
                <ul>
                    <li><b>SUPPORT</b></li>               <!--  support for using this website -->
                    <li><a href="" class="u">Guide</a></li>
                    <li><a href="">Help Center</a></li>
                    <li><a href="">Contact us</a></li>
                </ul>
                <ul>
                    <li><b>NETWORK SITES</b></li>           <!--  more websites by us -->
                    <li><a href=""class="u">1</a></li>
                    <li><a href="">2</a></li>
                    <li><a href="">3</a></li>
                </ul>
            </div> <!-- copyrights row -->
            <div class="copyright">
                2024  &copy; Copyright <strong><span>@ Sri Gaurav P V</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <a href="">Webdev@Sri Gaurav P V</a>
                <h3>Connect with us</h3>
            </div>
        </div>
        <div class="links"><!-- social media links -->
            <a href=""><i class="fa fa-instagram"></i></a>
            <a href=""><i class="fa fa-linkedin"></i></a>
            <a href=""><i class="fa fa-facebook-square"></i></a>
            <a href=""><i class="fa fa-volume-control-phone"></i></a>
            <a href=""><i class="fa fa-twitter"></i></a>
            <a href=""><i class="fa fa-youtube-play"></i></a>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
        /* code to make the 3 links work  */
    function activateTab(event, contentId) {
        event.preventDefault();
        // Get all links
        const navLinks = document.querySelectorAll('.nav-link');
        // Remove active class 
        navLinks.forEach(link => {
            link.classList.remove('active');
        });
        // Add active class 
        event.target.classList.add('active');
        // Change the content based on the clicked tab
        const content = document.getElementById('cardContent');
        switch(contentId) {
            case 'content1':
                content.innerHTML = `
                    <div class="container">
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Group1
                            </button>
                            </h5>
                        </div>
                    
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                             1. Purpose and Audience:
                    Purpose: The website serves as an online platform for users to order printing services for various materials such as business cards, brochures, flyers, posters, and more.
                    Target Audience: Businesses (small to large), event planners, marketers, designers, and individuals seeking custom printing solutions.
                            </div>
                        </div>
                        </div>
                        <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Group2
                            </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                           2. Services Offered:

                    Custom Printing: Options for personalized items like business cards, stationery, invitations, and promotional materials.
                    Design Services: Tools or services for creating or uploading designs, including templates for ease of use.
                    Wide Format Printing: Services for large posters, banners, and signs.
                    Digital Printing: Quick turnaround for short runs and high-quality prints.
                    Offset Printing: For larger quantities, providing cost-effectiveness with high-quality results.
                    Specialty Printing: Options like foil stamping, embossing, or die-cutting.
                            </div>
                        </div>
                        </div>
                        <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Group3
                            </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="card-body">
                            3. Features of the Website:
                    User-Friendly Interface: Easy navigation with clear categories for different types of printing services.
                    Design Tool: An online editor that allows users to create or customize their designs directly on the website.
                    Sample Gallery: Showcase previous work to demonstrate quality and inspire potential customers.
                    Pricing Calculator: Instant quotes based on size, quantity, and printing options.
                    Order Tracking: A system for customers to check the status of their orders.
                    Customer Support: Live chat, email, or phone support for assistance.
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                `;
                break;
            case 'content2':
                content.innerHTML = `
                    <h5 class="card-title">Second Tab </h5>
                    <p class="card-text">This is the content for Tab 2.</p>
                `;
                break;
            case 'content3':
                content.innerHTML = `
                    <h5 class="card-title">Third Tab Title</h5>
                    <p class="card-text">This is the content for Tab 3.</p>
                `;
                break;
           }
        }
        </script>
    </body>
</html>