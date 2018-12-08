<?php
//Return all events of a user
//Required parameters: uid

header("Content-Type: application/json; charset=UTF-8");
if(isset($_GET["uid"])){
    // Connecting to database
    include 'db_connect_inc.php';
    $uid = $_GET["uid"];
    $sql = "SELECT * FROM `user_event` ue INNER JOIN `event` e ON ue.event_id = e.event_id WHERE ue.uid='$uid' and ue.role='s'";
    $result = mysqli_query($connection, $sql);
	
    $data = array();
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $record["uid"] = $row["uid"];
        $record["event_id"] = $row["event_id"];
        $record["event_title"] = $row["event_title"];
        $record["address"] = $row["address"];
        $record["description"] = $row["description"];
        $record["role"] = $row["role"];
        $record["start_ts"] = $row["start_ts"];
        array_push($data, $record);
    }

    echo json_encode($data);
	//echo json_last_error();
	exit;
}
?>