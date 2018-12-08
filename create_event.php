<?php
    //Creating a new event
	//Parameters needed: All attributes of an event
    if (isset($_GET['uid']) && isset($_GET['event_title'])){
		$uid = $_GET["uid"];
		$role = 's';
		$event_title = $_GET["event_title"];
		$address = $_GET["address"];
		$description = $_GET["description"];
		$start_ts = null;
		if( isset($_GET["start_ts"]) &&  $_GET["start_ts"] != null && $_GET["start_ts"]!= "0000-00-00 00:00:00")
			$start_ts = $_GET["start_ts"];
		
		include 'db_connect_inc.php';

		//Find a suitable event id
		$find_event_id_sql = "SELECT MAX(event_id) AS max_event_id FROM event";
		$find_event_id_result = mysqli_query($connection, $find_event_id_sql);
		$row = mysqli_fetch_assoc($find_event_id_result);
		$event_id = $row["max_event_id"]+1;

		//Insert event
		$insert_event_sql = "INSERT INTO event(event_id, event_title, address, description)
							 VALUES ('$event_id', '$event_title', '$address', '$description')";
		if( $start_ts != null)                  
			$insert_event_sql = "INSERT INTO event(event_id, event_title, address, description, start_ts)
								 VALUES ('$event_id', '$event_title', '$address', '$description', '$start_ts')";

		$insert_event_result = mysqli_query($connection, $insert_event_sql);

		
		//Relating user and event
		$insert_user_event_sql = "INSERT INTO user_event(uid, event_id, role) 
								  VALUES ('$uid', '$event_id', '$role')";
		$inser_user_event_result = mysqli_query($connection, $insert_user_event_sql);
		
		
	}
  
?>