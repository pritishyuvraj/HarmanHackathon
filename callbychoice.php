<?php
session_start();
if(!isset($_SESSION["id"]))
	$_SESSION["id"] = 1;
echo "Car ID:".$_SESSION["id"];
echo "<hr>";
?>

<html>
<body>
<form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post" name = "calling">
CarID: <select name="id">
<option value="Null">All</option>
<option value="<?php echo $_SESSION["id"]; ?>">Self</option>
</select>
Time: <select name="time">
<option value="Null">All</option>
<option value="0-4">12am - 4am</option>
<option value="4-9">4am - 9pm</option>
<option value="9-18">9am - 6pm</option>
<option value="18-20">6pm - 8pm</option>
<option value="20-23.59">8pm - 12am</option>
</select>

Day: <select name="day">
<option value="">All</option>
<option value="Sunday">Sunday</option>
<option value="Monday">Monday</option>
<option value="Tuesday">Tuesday</option>
<option value="Wednesday">Wednesday</option>
<option value="Thursday">Thursday</option>
<option value="Friday">Friday</option>
<option value="Saturday">Saturday</option>
<option value="Sunday">Sunday</option>
</select>

Date: <input type = "text" placeholder = "Null" >
<input type = "hidden" name = "action" value = "call">
<input type = "submit" name = "submit">
</form>
</body>
</html>


<?php
//Exporting to Excel Sheet
function ExportExcel($table)
{
 
//$hostname = "localhost";
//$username = "root";
//$password = "";
$database = "harman";
 
//$conn = mysql_connect("localhost","$username","$password") or die(mysql_error());
mysql_select_db("$database", $conn) or die(mysql_error());

//$filename = "uploads/".strtotime("now").'.csv';
 $filename = "uploads/".strtotime("now").'.csv';
$sql = mysql_query("SELECT * FROM $table") or die(mysql_error());
 
$num_rows = mysql_num_rows($sql);
if($num_rows >= 1)
{
	$row = mysql_fetch_assoc($sql);
	$fp = fopen($filename, "w");
	$seperator = "";
	$comma = "";
 
	foreach ($row as $name => $value)
		{
			$seperator .= $comma . '' .str_replace('', '""', $name);
			$comma = ",";
		}
 
	$seperator .= "\n";
	fputs($fp, $seperator);
 
	mysql_data_seek($sql, 0);
	while($row = mysql_fetch_assoc($sql))
		{
			$seperator = "";
			$comma = "";
 
			foreach ($row as $name => $value) 
				{
					$seperator .= $comma . '' .str_replace('', '""', $value);
					$comma = ",";
				}
 
			$seperator .= "\n";
			fputs($fp, $seperator);
		}
 
	fclose($fp);	
	echo "Your file is ready. You can download it from <a href='$filename'>here!</a>";
}
else
{
	echo "There is no record in your Database";
}
 
 
}
//Ends here


$action=isset($_POST['action'])?$_POST['action']:null;
switch($action){
	case 'call':
				echo "";
	
				$con = mysqli_connect("localhost", "root", "root", "harman"); 
				if(mysqli_connect_errno()){
					echo"Failed to connect to server! Because".mysqli_connect_error();
				}
				if(isset($_POST["day"])){
					$day = $_POST["day"];
				}
				else{
					$day = "";
				}
				echo "Searching for ".$day;
				$query = "SELECT * FROM Main_db WHERE Day like '%$day%' order by Date, time";
				
				//To store to a file
				/*
				//$tempTableQuery = "CREATE TABLE temp(SELECT * FROM Main_db WHERE Day like '%$day%')";
				//include ("ExportToExcel.php");
				//ExportExcel("temp");
				if(!mysqli_query($con, $tempTableQuery)){
					echo "Failed to create temproray Table";
				}
				else{
					echo "/nCreated the table temp";
				}
				*/
				//$query = "SELECT * FROM Main_db";
				$extract=mysqli_query($con,$query);
				$see=array(array());
				$i=0;
				$j=0;
				
				while($row=mysqli_fetch_row($extract)){
					for($i=0;$i<5;$i++){
						$see[$j][$i]=$row[$i];
					}
					$j++;
				}
				//print_r($see);
				$file = fopen("temp.csv", "w") or die("can't open file");
				$str = "Hello world. It's a beautiful day.";
				foreach($see as $line){
				//fputcsv($file, explode(" ",$str));
				fputcsv($file, $line);
				//print_r($line);
				}
				fclose($file);
				break;
				
	default: echo "";
				break;
}

?>

<html>
<body><center>
<table border="1" width=70%>
<tr>
<td colspan="3"><h1>Cars</h1></td>
</tr>

<?php

				for($i=0;$i<$j;$i++){
				echo"<tr>";
				//echo"<td>".$i."</td>";
				for($z=0;$z<5;$z++){
					echo"<td>".$see[$i][$z];
					echo"</td>";
				}
				echo"</tr>";
			}	

//To print rules
			$output = shell_exec('sh index.sh');
			echo "<pre>$output</pre>";
?>