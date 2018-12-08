<?php
//Set up database connection

 $connection = mysqli_connect("localhost", "kelvin", "7ujmnhy6", "dontborderme_db");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>