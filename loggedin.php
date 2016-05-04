<?php
session_start();
//echo "hello";
echo "User ID ".$_SESSION["id"];
?>
<html>
<body>
<hr><a href = "callbychoice.php"> Go to Calling list </a><hr>
<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" 
	method = "post" name = "login">
CarID: <input type = "text" name = "carid" placeholder = "CarID">

Destination: <select name="des">
<option value="home">Home</option>
<option value="Mroman">Mall Romantic</option>
<option value="Mdescent">Mall Descent</option>
<option value="Rroman">Restaurant Romantic</option>
<option value="Rdescent">Restaurant Romantic</option>
<option value="Mdescent">Mall Descent</option>
<option value="Medico">Medico</option>
<option value="Hospital">Hospital</option>
<option value="office">Office</option>
</select>
<input type = "text" name = "time" placeholder = "time">
Day: <select name="day">
<option value="Sunday">Sunday</option>
<option value="Monday">Monday</option>
<option value="Tuesday">Tuesday</option>
<option value="Wednesday">Wednesday</option>
<option value="Thursday">Thursday</option>
<option value="Friday">Friday</option>
<option value="Saturday">Saturday</option>
<option value="Sunday">Sunday</option>
</select>
Date: <input type = "text" name = "date" placeholder = "Date">

<input type = "hidden" name = "action" value = "insert">
<input type = "submit" name = "submit" value = "submit">


</form>
<hr>
</body>
</html>


<?php

$action=isset($_POST['action'])?$_POST['action']:null;
switch($action){
	case 'insert': 
				$con=mysqli_connect("localhost","root","root","harman");
				if(mysqli_connect_errno()){
					echo"Failed to connect to server! Because".mysqli_connect_error();
				}
				$carid = $_POST["carid"];
				$Destination = $_POST["des"];
				$time = $_POST["time"];
				$day = $_POST["day"];
				$date = $_POST["date"];
				$insert = "INSERT INTO Main_db values('$carid', '$Destination','$time', '$day', '$date')";
				if(!mysqli_query($con,$insert)){ 
					echo "failed to update";
				}
				else{
					echo "added to database";
				}
				
	default: echo "";
	break;
}

?>