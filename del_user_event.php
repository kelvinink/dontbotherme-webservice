<?php
//Required parameters: uid, event_id
//If the user is a receiver, delete his own record.
//If the user is a sender, delete all related records.

if(isset($_GET["uid"])){
    // Connecting to database
    include 'db_connect_inc.php';
    $uid = $_GET["uid"];
    $event_id = $_GET["event_id"];
    //Check whether the user is a receiver of a sender
    $user_role_sql = "SELECT role FROM `user_event` WHERE `uid`='$uid' AND `event_id`='$event_id'";
    $role_result = mysqli_query($connection, $user_role_sql);
    $role = mysqli_fetch_array($role_result, MYSQLI_ASSOC);

    echo "role: ";
    echo $role["role"];

    if($role["role"] == 'r'){
        //For receiver, delete only his/her record
        echo "Excute receiver";
        $del_receiver_event_sql = "DELETE FROM `user_event` WHERE `uid`='$uid' AND `event_id`='$event_id'";
        mysqli_query($connection, $del_receiver_event_sql);
    }else{
        //For sender, delete all related record
        echo "Excute sender";
        $del_sender_event_sql = "DELETE FROM `user_event` WHERE `event_id`='$event_id'";
        $del_event_sql = "DELETE FROM `event` WHERE `event_id`='$event_id'";
        mysqli_query($connection, $del_sender_event_sql);
        mysqli_query($connection, $del_event_sql);
    }
}
?>