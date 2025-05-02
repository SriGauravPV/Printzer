<?php

session_start();
session_unset(); /* to remove the information from the session */
session_destroy(); /* destroy the session */
header("location: index.php"); /* send the user back to the login page */
exit;

?>