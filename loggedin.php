<?php
session_start();
//echo "hello";
echo "User ID ".$_SESSION["id"];
?>
<html>
<body>
<hr>
<table>

<tr><td><a href = "callbychoice.php"> Intelligent Car Routes </a></td></tr>
<tr><td><a href = "callforpersonallife.php"> Intelligent Daily Routine </a></td>
</tr>
</table>
<hr>
<h1><center>Intelligent User Destination Tracker</center></h1>
<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" 
	method = "post" name = "login">

<input type = "text" name = "carid" placeholder = "CarID:">

Destination: <select name="des">
<option value="home">Home</option>
<option value="CoupleMall">Couples Mall</option>
<option value="FamilyMall">Family Mall</option>
<option value="CoupleRestaur">Restaurant Romantic</option>
<option value="FamilyRestau">Restaurant Family</option>
<option value="Malldescent">Mall Descent</option>
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

<center><h1>Connected World</h1></center>
<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" 
	method = "post" name = "personal">
CarID: <input type = "text" name = "carid" placeholder = "CarID">

Task: <select name="des">
<option value="Wakeup">Wakeup</option>
<option value="Coffee">Coffee</option>
<option value="Shower">Shower</option>
<option value="OpenGarage">Garage Open</option>
<option value="CloseGarage">Garage Close</option>
<option value="LightingOn">Lighting On</option>
<option value="Medicines">Medicines</option>
<option value="MusicOn">Music On</option>
<option value="Sleep">Sleep</option>
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

<input type = "hidden" name = "action" value = "personal">
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

	case 'personal':
				$con = mysqli_connect("localhost", "root", "root", "harman");
				if(mysqli_connect_errno()){
					echo"Failed to connect to server! Because".mysqli_connect_error();
				}
				$carid = $_POST["carid"];
				$Destination = $_POST["des"].";".$_POST["time"];
				$time = $_POST["time"];
				$day = $_POST["day"];
				$date = $_POST["date"];
				$insert = "INSERT INTO personal values('$carid', '$Destination','$time', '$day', '$date')";
				if(!mysqli_query($con,$insert)){ 
					echo "failed to update";
				}
				else{
					echo "added to database";
				}
}

?>