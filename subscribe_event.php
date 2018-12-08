<?php
    //Subscribing an existing event
	
	if (isset($_GET['uid'])) {
		if (empty($_GET['uid']) || empty($_GET['event_id'])) {
		$error = "Uid or Event id is missed";
		echo "Uid or Event id is missed";
		}else{
			// Connecting to database
			include 'db_connect_inc.php';
			
			$uid = $_GET["uid"];
			$event_id = $_GET["event_id"];
			$role = 'r';

			$subscribe_sql = "INSERT INTO user_event(uid, event_id, role) 
                      VALUES ('$uid', '$event_id', '$role')";
					  
			$result = mysqli_query($connection, $subscribe_sql);
		}
}
?>