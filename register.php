<?php
    //Inserting user info into DB user table
    //Required parameters: uid(email), password
    $json_url = "./example.json";
    $json = file_get_contents($json_url);
    $data = json_decode($json, true);
    
    $uid = $data["uid"];
    $password = $data["password"];

    include 'db_connect_inc.php';  
    $register_sql = "INSERT INTO user(uid, password) VALUES ('$uid', '$password')";
    $result = mysqli_query($connection, $register_sql);

    /*foreach ($data as $key => $val) {
        echo "\$data[$key] => $val.\n";
    }*/
?>