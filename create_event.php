<?php
    //Subscribing an existing event
    //Required parameters: json
    $json_url = "./example.json";
    $json = file_get_contents($json_url);
    $data = json_decode($json, true);
    
    $uid = $data["uid"];
    $role = 's';
    $event_title = $data["event_title"];
    $address = $data["address"];
    $description = $data["description"];
    $start_ts = null;
    if( $data["start_ts"] != null)
        $start_ts = $data["start_ts"];
    
    include 'db_connect_inc.php';

    //Find a suitable event id
    $find_event_id_sql = "SELECT MAX(event_id) AS max_event_id FROM event";
    $find_event_id_result = mysqli_query($connection, $find_event_id_sql);
    $row = mysqli_fetch_assoc($find_event_id_result);
    $event_id = $row["max_event_id"]+1;

    //Insert event
    $insert_event_sql = "INSERT INTO event(event_id, event_title, address, description)
                         VALUES ('$event_id', '$event_title', '$address', '$description')";
    if( $data["start_ts"] != null)                  
        $insert_event_sql = "INSERT INTO event(event_id, event_title, address, description, start_ts)
                             VALUES ('$event_id', '$event_title', '$address', '$description', '$start_ts')";

    $insert_event_result = mysqli_query($connection, $insert_event_sql);

    //Relating user and event
    $insert_user_event_sql = "INSERT INTO user_event(uid, event_id, role) 
                              VALUES ('$uid', '$event_id', '$role')";
    $inser_user_event_result = mysqli_query($connection, $insert_user_event_sql);

?>