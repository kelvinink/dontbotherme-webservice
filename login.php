<?php
//Required parameters: uid(email), password

session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_GET['submit'])) {
    if (empty($_GET['uid']) || empty($_GET['password'])) {
    $error = "Username or Password is invalid";
    echo "Username or Password is invalid";
    }else{
        // Connecting to database
        include 'db_connect_inc.php';
        
        // Define $username and $password
        // Establishing Connection with Server by passing server_name, user_id and password as a parameter
        // To protect MySQL injection for Security purpose
        $username = stripslashes($_GET['uid']);
        $password = stripslashes($_GET['password']);
        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);
        // Selecting Database
        //$db = mysql_select_db("company", $connection);
        // SQL query to fetch information of registerd users and finds user match.
        $sql = "select * from user where password='$password' AND uid='$username'";
        $query = mysqli_query($connection, $sql);
        $rows = mysqli_num_rows($query);
        if ($rows == 1) {
            $_SESSION[$username]=$username; // Initializing Session
			echo "Your have successfully login as: $username & $password";
			echo "<br/> Seesion id is: $_SESSION[$username]";
            //header("location: profile.php"); // Redirecting To Other Page
        } else {
            $error = "Username or Password is invalid";
            echo "Username or Password is invalid";
        }
        mysqli_close($connection); // Closing Connection
    }
}

?>