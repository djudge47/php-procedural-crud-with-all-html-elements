<?php 

include 'dbconnect.php';

$current_user = $_GET['id'];

$delete_user = "delete from users where id=$current_user";

if(mysqli_query($conn, $delete_user)){
		echo "deleted";
		header("Location: http://localhost/php%20basics/");
	}
	else{
		mysqli_error($conn);
	}

 ?>