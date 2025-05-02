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


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="imgs/icon_project.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="style3.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="style.css">
    <title>About Us | Online Printing Service</title>
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
            z-index: 2; 
        }
    </style>
</head>
<body>
    <!-- header -->
<div class="header">
    <a href="welcome.php"><img src="imgs/icon_project.png" alt="Project Icon" style="width: 150px; height: 90px;padding-top: 0px;padding-bottom:20px;"></a>
        <div class="orders1" style="display:flex; padding-top:10px;">
            <div class=" my-3">
                <div class="d-flex align-items-center">
                <a href="Cap_log.php" style="color: #000; text-decoration: none; margin-right: 15px;padding-right:5px;">Capabilities</a>
                <a href="Aboutus_loggedin.php" style="color: #000; text-decoration: none; margin-right: 15px;padding-left:5px;">About Us</a>
            </div>
        </div>
    </div> 

    <div class="orders" style="padding-left: 450px; padding-top: 30px;">
            <a href="orders.php" class="a" style="color: #000;text-decoration: none; margin-left:120px;">Orders</a>
            <a href="" style="color: #000;text-decoration: none; margin-left:20px;">My File</a>
            <a href="" style="color: #000;text-decoration: none; margin-left:20px;"><?php echo substr($_SESSION['username'], 0, $atPosition);  ?></a>
            <a href="logout.php" id="contact" style="color: #000;text-decoration: none; margin-left:20px;">Logout</a>
            <a href="#"  style="color: #000;text-decoration: none; margin-left:10px;" data-toggle="modal" data-target="#exampleModal">Contact</a>
            <!-- Modal for the contact button -->
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
    <div class="image-aboutus">
        <img src="imgs/Screenshot 2024-09-26 115018.png" alt="" srcset="" >
    </div>
    <!-- features about us -->
    <div class="contant-aboutus">
        <h3>Faster One-stop Electronic Manufacturing</h3>
        <p>Founded in 2006, JLC works on building a one-stop industrial electronic platform, realizing digital PCBA processing by incorporating EDA, PCB, parts sourcing, and PCBA services. With increasing investment in innovation and digital system, we have been growing fast, and becoming a leading global PCB&PCBA manufacturer, providing the rapid production of high-reliability and cost-effective products.</p>
        <div class="cards-aboutus">
            <div class="card" style="width: 8rem;">
                <div class="card-body" style="flex-direction:column;">
                    <h5 class="card-title">100+</h5>
                    <p class="card-text">Countries.</p>
                </div>
            </div>
            <div class="card" style="width: 8rem;">
                <div class="card-body" style="flex-direction:column;">
                    <h5 class="card-title">4,80,000+</h5>
                    <p class="card-text">Customers.</p>
                </div>
            </div>
            <div class="card" style="width: 8rem;">
                <div class="card-body" style="flex-direction:column;">
                    <h5 class="card-title">6000+</h5>
                    <p class="card-text">Employees.</p>
                </div>
            </div>
            <div class="card" style="width: 10rem;">
                <div class="card-body" style="flex-direction:column;">
                    <h5 class="card-title">24/7</h5>
                    <p class="card-text">Online Service</p>
                </div>
            </div>
        </div>
    </div>
    <!-- about our mission for this project -->
    <div class="info-aboutus">
        <h6>Our mission</h6>
        <h3>Accelerating Global Hardware Innovation</h3>
        <p>JLC aims to accelerate hardware innovation by providing millions of enterprises, research institutes, and engineers with one-stop integrated electronic/mechanical service, including EDA software, PCB manufacturing, PCB Assembly, 3D Printing, and CNC Machining. JLC empowers flexible manufacturing through the integration of digital technology, self-built order platform, automated production, and intelligent warehousing. This enables us to meet customer demands for prototypes, small batch production, and the "fast delivery, high quality, customization, one-stop" experience.</p>
    </div>
    <!-- benefits about this website -->
    <div class="benefits" style="flex-direction:column;">
        <div class="card" style="width: 70rem; display: flex; flex-direction: row;">
            <img class="card-img-left" src="imgs/Screenshot 2024-09-26 115134.png" alt="Card image cap" style="width: 400px; height: 300px;">
            <div class="card-body" style="display: flex; flex-direction: column; padding-left: 15px; margin:50px 50px 50px 50px;">
                <h5 class="card-title">Higher Quality</h5>
                <p class="card-text">Ensuring quality and its consistent improvement are the two main guidelines of our company.
Our advanced PCB technology allows us to provide high precision boards suitable for industrial, military, aerospace, and medical applications.
We are continuously investing top-level base materials and advanced equipments for fully automated production lines, which enables us to offer our customers high throughput with consistently high quality.</p>
            </div>
        </div>
    </div>
    <div class="lower">
        <div class="card" style="width: 70rem; display: flex; flex-direction: row;">
            <div class="card-body" style="display: flex; flex-direction: column; padding-right: 15px; margin:50px 50px 50px 50px;">
                <h5 class="card-title">Lower Cost</h5>
                <p class="card-text">Since 2006, JLCPCB continuously driven to become more efficient and reduce costs. We promise to offer customers the most economic PCBs forever. JLCPCB makes cheapest but top quality PCBs possibly because of scale effect, extremely high production efficiency and less manpower cost.</p>
            </div>
            <img class="card-img-right" src="imgs/Screenshot 2024-09-26 115158.png" alt="Card image cap" style="width: 400px; height: 300px;">
        </div>
    </div>
    <div class="fast">
    <div class="card" style="width: 70rem; display: flex; flex-direction: row;">
            <img class="card-img-left" src="imgs/Screenshot 2024-09-26 115220.png" alt="Card image cap" style="width: 400px; height: 300px;">
            <div class="card-body" style="display: flex; flex-direction: column; padding-left: 15px; margin:50px 50px 50px 50px;">
                <h5 class="card-title">Faster Delivery</h5>
                <p class="card-text">Our easy-to-use online ordering system, professional and efficient customer service, digital manufacturing technology, full-automatic production lines, and stable logistics partners make every step to deliver you PCBs faster.</p>
            </div>
        </div>
    </div>
    <!-- some case studies -->
    <div class="case-studies">
        <h3 class="text-center">Case Studies</h3>
        <div class="cards-case-studies">
            <div class="card-deck">
                <div class="card" style="display: flex; flex-direction: column; align-items: center;">
                    <img class="card-img-top" src="imgs/Screenshot 2024-09-26 115241.png" alt="Card image cap" style="width: 300px; height: 200px; padding-top:10px;">
                    <div class="card-body" style="flex-direction:column;">
                        <h5 class="card-title">Hermit Retro ZX Spectrum Board</h5>
                        <p class="card-text">The Hermit Retro ZX Spectrum Board is a replacement board for original, or reproduction, ZX Spectrum cases. It sports HDMI, USB, I2C and joystick support in addition to a second MicroSD card for holding all your educational programs.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
                <div class="card" style="display: flex; flex-direction: column; align-items: center;">
                    <img class="card-img-top" src="imgs/Screenshot 2024-09-26 115259.png" alt="Card image cap" style="width: 300px; height: 200px; padding-top:10px;">
                    <div class="card-body" style="flex-direction:column;">
                        <h5 class="card-title">Petoi Bittle</h5>
                        <p class="card-text">Petoi Bittle is a tiny but powerful robot that can play tricks like real animals. You can bring Bittle to life by assembling its puzzle-like frame and downloading our demo codes on GitHub.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
                <div class="card" style="display: flex; flex-direction: column; align-items: center;">
                    <img class="card-img-top" src="imgs/Screenshot 2024-09-26 115316.png" alt="Card image cap" style="width: 300px; height: 200px; padding-top:10px;">
                    <div class="card-body" style="flex-direction:column;">
                        <h5 class="card-title">SAOSHYANT (Smart Home)</h5>
                        <p class="card-text">It can communicate with sensors and actuators via WiFi, LoRa(WAN), and BLE (version 5.0). It has a 4.3" 800x480 TFT display with a capacitive touch panel and onboard sensors to sense gestures, luminosity, proximity.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer -->
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
                2024  &copy; Copyright <strong><span>@ Printzer</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <a href="">Webdev@ Printzer</a>
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
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFQPfXxwtjNerxuJ5+WF/6rmDaKxdTN2c6qlrL2CpcmoFJV6l7W54lG+NuAb50" crossorigin="anonymous"></script>
 -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>