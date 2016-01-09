<?php 

$servername = "db_host";
$sql_username = "db_username";
$sql_password = "db_password";
$db_name = "db_name";

$conn = mysqli_connect($servername, $sql_username, $sql_password, $db_name);

// if(!$conn){
// 	die("Connection Failed" . mysqli_connect_error());
// }

if(mysqli_connect_errno()){
    die("Database Connection Failed: " .
        mysqli_connect_error() .
        " (". mysqli_connect_errno() .") "
    );
}

//echo "Connection Successful";

?>