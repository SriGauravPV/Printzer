<?php
session_start();/* starting the session for this page */

if(!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin']!=true){/* if the user is not loged in */
    header("location: admin.php");                                  /* send the user back to the login page */
    exit;
}
$atPosition = strpos($_SESSION['username'], '@');
/* <?php $_SESSION['username'] ?> */
/* <?php echo $_SESSION['username'] ?> */

?>

<?php
/* connection with the database */
include 'partials/_dbconnect.php'; // database connection script

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error()); // Check and handle connection error
}
// Handle delete request
if(isset($_GET['delete'])){
    $sno = $_GET['delete']; // Get the 'sno' parameter from the URL
    $delete = true; // Flag indicating a delete action
    $sql = "DELETE FROM `3dprint` WHERE `sno` = $sno"; // SQL query to delete record
    $result = mysqli_query($conn, $sql); // Execute delete query
}

// Handles form for editing records
if($_SERVER['REQUEST_METHOD']=='POST'){
    if (isset($_POST['snoEdit'])){ // Check if edit form is submitted
        $sno = $_POST["snoEdit"]; // Get the record's sno
        // Get all the edited fields
        $size = $_POST["sizeEdir"];
        $Design = $_POST["DesignEdit"];
        $Orientation = $_POST["OrientationEdit"];
        $sleeves = $_POST["sleevesEdit"];
        $Qty = $_POST["qtyEdit"];
        $Product_Use = $_POST["Product_UseEdit"];
        $Build_Time = $_POST["Build_TimeEdit"];
        $Package_Desc = $_POST["Package_DescEdit"];
        
        //  SQL update query
        $sql = "UPDATE `shirt` SET `size` = '$size', `Design` = '$Design',`Orientation` = '$Orientation', `sleeves` = '$sleeves', `Qty` = '$Qty', `Qty` = '$Qty', `Product_Use` = '$Product_Use', `Build_Time` = '$Build_Time', `Package_Desc` = '$Package_Desc'WHERE `shirt`.`sno` = $sno";
        
        //  the update query
        $result = mysqli_query($conn, $sql);
        if($result){
            $update = true; // Flag indicating successful update
        } else {
            echo "We could not update the record successfully"; // Handle update error
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="icon" href="imgs/icon_project.png">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <title>Admin | Online Printing Service</title>
    <style>
        .table-wrapper {
            width: 85%;
            overflow-x: auto; /* Enables horizontal scrolling */
        }

        table {
            width: 85%; /* Let the table take full width */
            min-width: 900px; /* Minimum width forces scroll when content exceeds it */
            border-collapse: collapse;
        }
    </style>
</head>

<body>
  <!-- Modal for editing records -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit this Note</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <form action="/printzer/admin_welcome.php" method="POST"> <!-- Form for editing a record -->
                <div class="modal-body">
                    <input type="hidden" name="snoEdit" id="snoEdit"> <!-- Hidden input for serial number -->
                    <div class="form-group">
                        <label for="size">size</label>
                        <textarea class="form-control" id="sizeEdit" name="sizeEdit" rows="1"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="Design">Design</label>
                        <input type="text" class="form-control" id="DesignEdit" name="DesignEdit" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="Orientation">Orientation</label>
                        <textarea class="form-control" id="OrientationEdit" name="OrientationEdit" rows="1"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="sleeves">sleeves</label>
                        <textarea class="form-control" id="sleevesEdit" name="sleevesEdit" rows="1"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="qty">Qty</label>
                        <textarea class="form-control" id="qtyEdit" name="qtyEdit" rows="1"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="Product_Use">Product_Use</label>
                        <textarea class="form-control" id="Product_UseEdit" name="Product_UseEdit" rows="1"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="Build_Time">Build_Time</label>
                        <textarea class="form-control" id="Build_TimeEdit" name="Build_TimeEdit" rows="1"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="Package_Desc">Package_Desc</label>
                        <textarea class="form-control" id="Package_DescEdit" name="Package_DesctEdit" rows="1"></textarea>
                    </div>
                </div>
                <div class="modal-footer d-block mr-auto">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button> <!-- Submit button -->
                </div>
            </form>
        </div>
        </div>
    </div>

    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"><img src="imgs/icon_project.png" alt="Project Icon" style="width: 150px; height: 80px;padding-top: 0px;padding-bottom:20px;"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="aboutus_admin.php">About Us</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Profile</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item my-lg-0">
            <a class="nav-link" href="/printzer/logout.php" id="contact" style="color: #000;text-decoration: none; margin-left:20px;">Logout</a>
            </li>

        </ul>
        </div>
    </nav>
    <div class="di" style="display:flex;">
    <div class="dv" style="margin:55px; margin-top:150px;">
    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a class="nav-link " href="admin_welcome.php" style="width:150px;">Normal Printing</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="admin_3d.php" style="width:150px;">3D Printing</a>
        </li>
        <li class="nav-item">   
            <a class="nav-link active" href="admin_shirt_p.php " style="width:150px;">Shirt Printing</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#" style="width:150px;">Edit Contents</a>
        </li>
    </ul>
    </div>
    <div class="container my-4 mb-3 text-center">
    <div class="d2">
        <h3>Quotation required By Users For Shirt Printing</h3>
        <div class="table-wrapper" class="flex-direction:row;">
        <table class="table" id="myTable">
        <thead>
            <tr>
            <th scope="col">slno</th>
            <th scope="col">email</th>
            <th scope="col">filename</th>
            <th scope="col">size</th>
            <th scope="col">Design</th>
            <th scope="col">Orientation</th>
            <th scope="col">sleeves</th>
            <th scope="col">qty</th>
            <th scope="col">Product_Use</th>
            <th scope="col">Build_Time</th>
            <th scope="col">Package_Desc</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql="select * from shirt"; // Query to fetch all records from the 'information' table
            $result=mysqli_query($conn,$sql); // Execute the query
            $sno=0; // Initialize serial number for table rows
            while($row=mysqli_fetch_assoc($result)){ // Loop through each record
                $sno=$sno+1; // Increment serial number
                // Display each record in a table row
                echo"<tr>
                    <th scope='row'>". $sno . "</th>
                    <td>". $row['username'] . "</td>
                    <td>". $row['filename'] . "</td>
                    <td>". $row['size'] . "</td>
                    <td>". $row['Design'] . "</td>
                    <td>". $row['Orientation'] . "</td>
                    <td>". $row['sleeves'] . "</td>
                    <td>". $row['Qty'] . "</td>
                    <td>". $row['Product_Use'] . "</td>
                    <td>". $row['Build_Time'] . "</td>
                    <td>". $row['Package_Desc'] . "</td>
                    <td> 
                        <button class='edit btn btn-sm btn-primary' style='margin-bottom:10px;' id=".$row['sno'].">Edit</button><button class='delete btn btn-sm btn-primary d-inline-blockd-inline-block' id=d".$row['sno'].">Delete</button> 
                    </td>
                </tr>";
            }
            ?>
        </tbody>
        </table>
        </div>
        </div>
    </div>
    </div>

    <!-- JavaScript libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable(); // Initialize DataTables for sorting and pagination
        });

        // Handle edit button clicks
        // Handle edit button clicks
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
        element.addEventListener("click", (e) => {
        tr = e.target.parentNode.parentNode; // Get the row of the clicked button
        // Get values from the row
        size = tr.getElementsByTagName("td")[3].innerText; // Updated index to match table column
        Design = tr.getElementsByTagName("td")[4].innerText;
        Orientation = tr.getElementsByTagName("td")[5].innerText;
        sleeves = tr.getElementsByTagName("td")[6].innerText;
        Qty = tr.getElementsByTagName("td")[7].innerText;
        Product_Use = tr.getElementsByTagName("td")[8].innerText;
        Build_Time = tr.getElementsByTagName("td")[9].innerText;
        Package_Desc = tr.getElementsByTagName("td")[10].innerText;
        // Populate the edit modal with the values
        document.getElementById('sizeEdit').value = size;
        document.getElementById('DesignEdit').value = Design;
        document.getElementById('OrientationEdit').value = Orientation;
        document.getElementById('sleeveshEdit').value = sleeves;
        document.getElementById('QtyEdit').value = Qty;
        document.getElementById('Product_UseEdit').value = Product_Use;
        document.getElementById('Build_TimeEdit').value = Build_Time;
        document.getElementById('Package_DescEdit').value = Package_Desc;
        // Assign snoEdit (ID) for the form submission
        document.getElementById('snoEdit').value = e.target.id;

        $('#editModal').modal('toggle'); // Show the modal
    });
});


        // Handle delete button clicks
        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit ");
                sno = e.target.id.substr(1); // Extract the serial number from the button's ID

                // Confirm deletion
                if (confirm("Are you sure you want to delete this note!")) {
                    window.location = `/printzer/admin_welcome.php?delete=${sno}`; // Redirect to delete the record
                } else {
                    console.log("no"); // Log if deletion is cancelled
                }
            });
        });
    </script>
</body>
</html>
