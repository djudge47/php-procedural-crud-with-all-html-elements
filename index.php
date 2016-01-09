<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>PHP Form Basics</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/app.css">

	<script src="js/jquery-2.0.3.min.js"></script>
	<script src="js/app.js"></script>
</head>
<body>
	
	<div class="container">
	<div class="col-md-3 col-md-offset-5">
		<h1><a href="http://localhost/php%20basics/">Home</a></h1>
	</div>
	<div class="col-md-4"></div>
		<div class="col-md-5">
		<h1>Insert User</h1>
			<form name="user_form" action="index.php" method="GET">
				<label for="username">Username</label>
				<input type="text" id="username" name="username" placeholder="Enter username">
				<br>

				<label for="password">Password</label>
				<input type="password" id="password" name="password" placeholder="Enter password">
				<br>
				
				<label for="q1">Course Interested:</label><br>
				<input type="checkbox" name="q1[]" id="user_interest" value="Web Development">
				<label>Web Development</label><br>
				<input type="checkbox" name="q1[]" id="user_interest" value="Web Design">
				<label>Web Design</label><br>
				<input type="checkbox" name="q1[]" id="user_interest" value="Programming">
				<label>Programming</label><br>
				
				<br>

				<label>Interested:</label><br>
				<input type="radio" name="interested" value="1"> Yes <br>	
				<input type="radio" name="interested" value="0"> No <br>

				<label for="designation">designation</label>
				<select id="designation" name="designation[]" multiple>
					<optgroup label="web">
						<option value="developer" >developer</option>
					<option value="designer" >designer</option>
					</optgroup>
					<optgroup label="basic">
						<option value="operator">operator</option>						
					</optgroup>
				</select><br>
				<input type="submit" value="insert" name="insert">
			</form>
		</div>

<?php 
include 'dbconnect.php';

if(isset($_GET['insert'])){
	$username = $_GET['username'];
$password = $_GET['password'];
$course_interested = implode(',', $_GET['q1']);
$interested = $_GET['interested'];
$designation = implode(',', $_GET['designation']);

$insert_users = "insert into users(username, password, course_interested, interested, designation) values('$username', '$password', '$course_interested', '$interested', '$designation')";

if($username != "" || $password != ""){
	if(mysqli_query($conn, $insert_users)){
		//echo "Row Inserted";
		header("Location: http://localhost/php%20basics/");
	}
	else{
		echo mysqli_error($conn);
	}

}
}



 ?>
		<div class="col-md-7">
			<table class="table">
				<tr>
					<th>Username</th>
					<th>Password</th>
					<th>Course Interested</th>
					<th>Interested</th>
					<th>Designation</th>
				</tr>
				
					<?php 
						$select_users = "select * from users";
						$result_select_users = mysqli_query($conn, $select_users);

						while ($row = mysqli_fetch_assoc($result_select_users)) {
							echo "<tr>";
							echo "<td>". $row['username']. "</td>";
							echo "<td>". $row['password']. "</td>";
							echo "<td>". $row['course_interested']. "</td>";
							echo "<td>". $row['interested']. "</td>";
							echo "<td>". $row['designation']. "</td>";
							echo "<td><a href=update.php?id=$row[id]>Edit</a></td>";
							echo "<td><a href=delete.php?id=$row[id] onClick=deleteRecord()>Delete</a></td>";
							echo "<tr/>";
						}
					 ?>
			</table>
		</div>
	</div>
<script type="text/javascript">
            function deleteRecord()
            {
                if (confirm("Do you really delete the user?")) {
                    //alert("user Deleted");
                }
                else {
                    //alert("user not deleted");
                    event.preventDefault();
                }
            }
        </script>
</body>
</html>

