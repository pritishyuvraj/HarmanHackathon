<html>
<body>
<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post" name = "login">
Destination1: <select name="des">
<option value="home">Home</option>




<option value="office">Office</option>
</select>

Destination2: <select name="des2">
<option value="null">Null</option>


<option value="FamilyMall">Family Mall</option>


<option value="Hospital">Hospital</option>

</select>

<input type = "hidden" name = "action" value = "insert">
<input type = "submit" name = "submit" value = "submit">
</form>
</body>
</html>


<?php

$action=isset($_POST['action'])?$_POST['action']:null;

switch($action){
	
	case 'insert': if((isset($_POST["des"])) && $_POST["des2"]=="null") {
							
						if ($_POST["des"] == "home"){
							echo "Prediction: Office";
						}
						
						if($_POST["des"] == "office"){
							echo "Prediction: Home";
					}
				}
				//echo $_POST["des"]." ".$_POST["des2"];
				else if((isset($_POST["des"])) && ($_POST["des2"]!="null")) {
					//echo "Both Set";
						if($_POST["des"]=="home" && $_POST["des2"]=="Hospital"){
								echo "<h3>User Likely to Visit:<u> Medico</h3></u>";
							}
						if($_POST["des"]=="home" && $_POST["des2"]=="FamilyMall"){
							echo "<h3>User Likely to Visit: <u>Family Restaurant</h3></u>";
						}
					}
					break;
						
	default: echo "";
}

?>