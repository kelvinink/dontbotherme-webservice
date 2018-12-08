<?php
    //Creating a new event
	//Parameters needed: All attributes of an event
    if (isset($_GET['uid']) && isset($_GET['event_id']) && isset($_GET['event_title']) && isset($_GET['role'])){
		if($_GET["role"] != "s")
			return;
		
		$uid = $_GET["uid"];
		$event_id = $_GET["event_id"];
		$event_title = $_GET["event_title"];
		$address = $_GET["address"];
		$description = $_GET["description"];
		$role = 's';
		$start_ts = null;
		if( $_GET["start_ts"] != null &&  $_GET["start_ts"] != "0000-00-00 00:00:00")
			$start_ts = $_GET["start_ts"];
		
		include 'db_connect_inc.php';

		
		//Update event
		$update_event_sql = "UPDATE event 
							 SET event_title = '$event_title', address = '$address', description = '$description'
							 WHERE event_id = '$event_id'";

		if( $_GET["start_ts"] != null){
			$update_event_sql = "UPDATE event 
							 SET event_title = '$event_title', address = '$address', description = '$description', start_ts = '$start_ts'
							 WHERE event_id = '$event_id'";
		}
		$update_event_result = mysqli_query($connection, $update_event_sql);

	}
  
?>