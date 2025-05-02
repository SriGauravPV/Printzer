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
    $sql = "DELETE FROM `orders` WHERE `sno` = $sno"; // SQL query to delete record
    $result = mysqli_query($conn, $sql); // Execute delete query
}

// Handles form for editing records
if($_SERVER['REQUEST_METHOD']=='POST'){
    if (isset($_POST['snoEdit'])){ // Check if edit form is submitted
        $sno = $_POST["snoEdit"]; // Get the record's sno
        // Get all the edited fields
        $type = $_POST["typeEdit"];
        $size = $_POST["sizeEdit"];
        $types = $_POST["typesEdit"];
        $borders = $_POST["bordersEdit"];
        $type_print = $_POST["type_printEdit"];
        $Qty = $_POST["QtyEdit"];
        $prod = $_POST["prodEdit"];
        $Package_type = $_POST["Package_typeEdit"];
        $no_sheet = $_POST["no_sheetEdit"];
        $Print_Quality = $_POST["Print_QualityEdit"];
        $h_f = $_POST["h_fEdit"];
        $Print_Resolution = $_POST["Print_ResolutionEdit"];
        $Finishing_Options = $_POST["Finishing_OptionsEdit"];
        $Ink_Usage = $_POST["Ink_UsageEdit"];
        $Color_Management = $_POST["Color_ManagementEdit"];
        
        //  SQL update query
        $sql = "UPDATE `orders` SET `type` = '$type', `size` = '$size',`types` = '$types', `borders` = '$borders', `type_print` = '$type_print', `Qty` = '$Qty', `prod` = '$prod', `Package_type` = '$Package_type',`no_sheet` = '$no_sheet',`Print_Quality` = '$Print_Quality',`h_f` = '$h_f',`Print_Resolution` = '$Print_Resolution',`Finishing_Options` = '$Finishing_Options',`Ink_Usage` = '$Ink_Usage',`Color_Management` = '$Color_Management' WHERE `orders`.`sno` = $sno";
        
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
            width: 100%; /* Let the table take full width */
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
                        <label for="type">type</label>
                        <input type="text" class="form-control" id="typeEdit" name="typeEdit" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="size">size</label>
                        <textarea class="form-control" id="sizeEdit" name="sizeEdit" rows="1"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="types">types</label>
                        <input type="text" class="form-control" id="typesEdit" name="typesEdit" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="borders">borders</label>
                        <textarea class="form-control" id="bordersEdit" name="bordersEdit" rows="1"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="type_print">type_of_print</label>
                        <textarea class="form-control" id="type_printEdit" name="type_printEdit" rows="1"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="Qty">Qty</label>
                        <textarea class="form-control" id="QtyEdit" name="QtyEdit" rows="1"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="prod">prod</label>
                        <textarea class="form-control" id="prodEdit" name="prodEdit" rows="1"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="Package_type">Package_type</label>
                        <textarea class="form-control" id="Package_typeEdit" name="Package_typeEdit" rows="1"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="no_sheet">no_sheet</label>
                        <textarea class="form-control" id="no_sheetEdit" name="no_sheetEdit" rows="1"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="Print_Quality">Print_Quality</label>
                        <textarea class="form-control" id="Print_QualityEdit" name="Print_QualityEdit" rows="1"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="h_f">h_f</label>
                        <textarea class="form-control" id="h_fEdit" name="h_fEdit" rows="1"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="Print_Resolution">Print_Resolution</label>
                        <textarea class="form-control" id="Print_ResolutionEdit" name="Print_ResolutionEdit" rows="1"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="Finishing_Options">Finishing_Options</label>
                        <textarea class="form-control" id="Finishing_OptionsEdit" name="Finishing_OptionsEdit" rows="1"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="Ink_Usage">Ink_Usage</label>
                        <textarea class="form-control" id="Ink_UsageEdit" name="Ink_UsageEdit" rows="1"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="Color_Management">Color_Management</label>
                        <textarea class="form-control" id="Color_ManagementEdit" name="Color_ManagementEdit" rows="1"></textarea>
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
            <li class="nav-item" style="margin:6px;">
                <a href="#"  style="color: #000;text-decoration: none; margin-left:10px;" data-toggle="modal" data-target="#exampleModal" style="margin-top:20px;">Profile</a>
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
                            <h4 style="margin-bottom:20px;">Profile</h4>
                            <p>User name:<?php echo substr($_SESSION['username'], 0, $atPosition);  ?></p>
                            <h5>Want to share a contact no please share</h5>
                            <p>Phone: +91 9898989898</p>
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
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
            <a class="nav-link active" href="admin_welcome.php" style="width:150px;">Normal Printing</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="admin_3d.php" style="width:150px;">3D Printing</a>
        </li>
        <li class="nav-item">   
            <a class="nav-link" href="admin_shirt_p.php" style="width:150px;">Shirt Printing</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#" style="width:150px;">Edit Contents</a>
        </li>
    </ul>
    </div>
    <div class="container my-4 mb-3 text-center">
    <div class="d2">
        <h3>Quotation required By Users for Printing</h3>
        <div class="table-wrapper" class="flex-direction:row;">
        <table class="table" id="myTable">
        <thead>
            <tr>
            <th scope="col">slno</th>
            <th scope="col">email</th>
            <th scope="col">type</th>
            <th scope="col">filename</th>
            <th scope="col">size</th>
            <th scope="col">types</th>
            <th scope="col">borders</th>
            <th scope="col">type_print</th>
            <th scope="col">qty</th>
            <th scope="col">prod</th>
            <th scope="col">Package_type</th>
            <th scope="col">no_sheet</th>
            <th scope="col">Print_Quality</th>
            <th scope="col">h_f</th>
            <th scope="col">Print_Resolution</th>
            <th scope="col">Finishing_Options</th>
            <th scope="col">Ink_Usage</th>
            <th scope="col">Color_Management</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql="select * from orders"; // Query to fetch all records from the 'information' table
            $result=mysqli_query($conn,$sql); // Execute the query
            $sno=0; // Initialize serial number for table rows
            while($row=mysqli_fetch_assoc($result)){ // Loop through each record
                $sno=$sno+1; // Increment serial number
                // Display each record in a table row
                echo"<tr>
                    <th scope='row'>". $sno . "</th>
                    <td>". $row['username'] . "</td>
                    <td>". $row['type'] . "</td>
                    <td>". $row['filename'] . "</td>
                    <td>". $row['size'] . "</td>
                    <td>". $row['types'] . "</td>
                    <td>". $row['borders'] . "</td>
                    <td>". $row['type_print'] . "</td>
                    <td>". $row['Qty'] . "</td>
                    <td>". $row['prod'] . "</td>
                    <td>". $row['Package_type'] . "</td>
                    <td>". $row['no_sheet'] . "</td>
                    <td>". $row['Print_Quality'] . "</td>
                    <td>". $row['h_f'] . "</td>
                    <td>". $row['Print_Resolution'] . "</td>
                    <td>". $row['Finishing_Options'] . "</td>
                    <td>". $row['Ink_Usage'] . "</td>
                    <td>". $row['Color_Management'] . "</td>
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
        type = tr.getElementsByTagName("td")[1].innerText; // Updated index to match table column
        size = tr.getElementsByTagName("td")[3].innerText;
        types = tr.getElementsByTagName("td")[4].innerText;
        borders = tr.getElementsByTagName("td")[5].innerText;
        type_print = tr.getElementsByTagName("td")[6].innerText;
        Qty = tr.getElementsByTagName("td")[7].innerText;
        prod = tr.getElementsByTagName("td")[8].innerText;
        Package_type = tr.getElementsByTagName("td")[9].innerText;
        no_sheet = tr.getElementsByTagName("td")[10].innerText;
        Print_Quality = tr.getElementsByTagName("td")[11].innerText;
        h_f = tr.getElementsByTagName("td")[12].innerText;
        Print_Resolution = tr.getElementsByTagName("td")[13].innerText;
        Finishing_Options = tr.getElementsByTagName("td")[14].innerText;
        Ink_Usage = tr.getElementsByTagName("td")[15].innerText;
        Color_Management = tr.getElementsByTagName("td")[16].innerText;

        // Populate the edit modal with the values
        document.getElementById('typeEdit').value = type;
        document.getElementById('sizeEdit').value = size;
        document.getElementById('typesEdit').value = types;
        document.getElementById('bordersEdit').value = borders;
        document.getElementById('type_printEdit').value = type_print;

        // Ensure numeric fields are populated as text for now (the form will handle number inputs)
        document.getElementById('QtyEdit').value = Qty;
        document.getElementById('prodEdit').value = prod;
        document.getElementById('Package_typeEdit').value = Package_type;
        document.getElementById('no_sheetEdit').value = no_sheet;
        document.getElementById('Print_QualityEdit').value = Print_Quality;
        document.getElementById('h_fEdit').value = h_f;
        document.getElementById('Print_ResolutionEdit').value = Print_Resolution;
        document.getElementById('Finishing_OptionsEdit').value = Finishing_Options;
        document.getElementById('Ink_UsageEdit').value = Ink_Usage;
        document.getElementById('Color_ManagementEdit').value = Color_Management;

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
