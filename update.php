<?php 

include 'dbconnect.php';

$current_user = $_GET['id'];

$update_user = "select * from users where id=$current_user limit 1";

if($result = mysqli_query($conn, $update_user)){
	while($row = mysqli_fetch_row($result)){
		$username = $row[0];
		$password = $row[1];
		$interested = $row[2];
		$course_interested = $row[3];
		$designation = $row[4];
	}

}

 ?>


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
	<h1>Update User (<?php echo $username; ?>)</h1>
			<form name="user_form" action="update.php" method="GET">
				<input type='hidden' name='id' value='<?php echo $_GET['id']; ?>' />

				<label for="username">Username</label>
				<input type="text" id="username" name="username" placeholder="Enter username" value="<?php echo $username; ?>">
				<br>

				<label for="password">Password</label>
				<input type="password" id="password" name="password" placeholder="Enter password" value="<?php echo $password; ?>">
				<br>
				<?php 
					$courses = explode(",", $course_interested); 
					//print_r($courses);
				?>
				<label for="q1">Course Interested:</label><br>				
				<input type="checkbox" name="q1[]" id="user_interest" value="Web Development" <?php if(isset($courses[0])) echo 'checked="checked"'; ?>>
				<label>Web Development</label><br>
				<input type="checkbox" name="q1[]" id="user_interest" value="Web Design"  <?php if(isset($courses[1])) echo 'checked="checked"'; ?>>
				<label>Web Design</label><br>
				<input type="checkbox" name="q1[]" id="user_interest" value="Programming"  <?php if(isset($courses[2])) echo 'checked="checked"'; ?>>
				<label>Programming</label><br>
				
				<br>

				<label>Interested:</label><br>
				<input type="radio" name="interested" value="1" <?php if($interested == "1") echo 'checked="checked"'; ?>> Yes <br>	
				<input type="radio" name="interested" value="0" <?php if($interested == "0") echo 'checked="checked"'; ?>> No <br>


				<?php 
					$designations = explode(",", $designation); 
					print_r($designations);
				?>
				<label for="designation">designation</label>
				<select id="designation" name="designation[]" multiple>
					<optgroup label="web">
						<option value="developer"  <?php if(isset($designations[0])) echo 'selected="selected"'; ?>>developer</option>
					<option value="designer" <?php if(isset($designations[1])) echo 'selected="selected"'; ?>>designer</option>
					</optgroup>
					<optgroup label="basic" <?php if(isset($designations[2])) echo 'selected="selected"'; ?>>
						<option value="operator">operator</option>						
					</optgroup>
				</select><br>

				<input name="update" type="submit" value="update">
			</form>
		</div>

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

</body>
</html>




<?php 


if(isset($_GET['update'])){
	$new_username = $_GET['username'];
$new_password = $_GET['password'];
$current_user = $_GET['id'];
$course_interested = implode(",", $_GET['q1']);
$interested = $_GET['interested'];
$designation = implode(',', $_GET['designation']);
$update_query = "update users set username='$new_username', password='$new_password', course_interested = '$course_interested', interested='$interested', designation='$designation' where id='$current_user'";
	if(mysqli_query($conn, $update_query)){
		// echo "Update successful";
		header("Location: http://localhost/php%20basics/");
	}
	else{
		echo "unsuccssful";
	}
}

 ?>


