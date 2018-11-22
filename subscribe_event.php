<?php
    //Subscribing an existing event
    //Required parameters: json
    $json_url = "./example.json";
    $json = file_get_contents($json_url);
    $data = json_decode($json, true);
    
    $uid = $data["uid"];
    $event_id = $data["event_id"];
    $role = 'r';

    include 'db_connect_inc.php';  
    $subscribe_sql = "INSERT INTO user_event(uid, event_id, role) 
                      VALUES ('$uid', '$event_id', '$role')";
    $result = mysqli_query($connection, $subscribe_sql);
?>