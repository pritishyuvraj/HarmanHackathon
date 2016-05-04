<?php
session_start();
?>
<html>
<body>
hello
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
	method="post" style="color:white;" 
	name="login">

CarLogin: <input type = "text" name = "carid" maxlength="2" placeholder= "Car ID">
<input type="hidden" value="login" name="action">
Submit: <input type = "submit" name = "login" value = "Login">
</form>
</body>
</html>


<?php

$action=isset($_POST['action'])?$_POST['action']:null;
switch($action){
	case 'login': 
				echo $_POST["carid"];
				$_SESSION["id"] = $_POST["carid"];
				header('Location: loggedin.php');
	default: echo "hi";
	break;
}

?>
