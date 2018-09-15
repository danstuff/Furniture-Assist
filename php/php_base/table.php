<?php 
//configuration variables
$sql_hostname = "localhost";
$sql_username = "root";
$sql_password = "";

$database_name = "fa"; 
$table_name = "";

$con;

function connectTable($name, $properties){
	global $sql_hostname, $sql_username, $sql_password, $database_name, $table_name, $con;

	//connect to SQL server
	$con = mysqli_connect($sql_hostname, $sql_username, $sql_password);

	if(!$con){
		echo "There was an error connecting to the database. Please try again.\n";
		die();
	}
	
	//create database if not created already
	mysqli_query($con, "CREATE DATABASE $database_name");

	//use database
	mysqli_query($con, "USE $database_name");
	
	//create table if not created already
	$table_name = $name;
	
	if($properties != ""){
		mysqli_query($con, "CREATE TABLE $table_name (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
		date_added DATETIME NOT NULL DEFAULT NOW(),"
		.$properties.",
		time_approved DATETIME,
		approved BOOL DEFAULT 0)");
		echo mysqli_error($con);
	}
}

function newTableEntry($name_list){
	global $sql_hostname, $sql_username, $sql_password, $database_name, $table_name, $con;
	
	$query = "INSERT INTO $table_name (";

	//set column names like (n1, n2,.... nx)
	$first = 1;
	foreach($name_list as $name){
		if($first == 1){
			$query = $query.$name;
			$first = 0;
		}else{
			$query = $query.",".$name;
		}
	}
	
	//set values like ('v1', 'v2',.... 'vx')
	$query = $query.") VALUES (";
	$first = 1;
	foreach($name_list as $name){
		$value = "";
	
		if(is_array($_POST["$name"])){
			foreach($_POST["$name"] as $elem){
				$value = $value." ".htmlspecialchars($elem);
			}
		}else{	
			$value = htmlspecialchars($_POST["$name"]); 
		}
		
		if($first == 1){
			$query = $query."'".$value."'";
			$first = 0;
		}else{
			$query = $query.",'".$value."'";
		}
	}
		
	$query = $query.")";
	
	//send the query
	mysqli_query($con, $query);
	echo mysqli_error($con);
}

function editTableEntry($id, $sql_set){
	global $sql_hostname, $sql_username, $sql_password, $database_name, $table_name, $con;
	
	mysqli_query($con, "UPDATE $table_name
						SET $sql_set
						WHERE id=$id");
}

function emailTableEntry(){
	$to=$_POST["email_address"];
	$subject="A Message From Furniture Assist";
	$message="<h1>Hello ".$_POST["full_name"]."!</h1><br>";
	$headers="From: noreply@furnitureassist.com";
	
	$to_admin="admin@furnitureassist.com";
	$subject_admin="A Message From Furniture Assist";
	$message_admin="";
	$headers_admin="From: noreply@furnitureassist.com";
	
	//if it was a volunteer...
	if(array_key_exists("interests", $_POST)){
		$subject="Thank you for choosing to volunteer!";
		$message=$message.
			"<h2>Thank you for choosing to volunteer with Furniture Assist.</h2><br>
			<p>As a part of the Furniture Assist team, you will be actively working to make a difference in your community. A member of the Furniture Assist team should reach out to you within a week. In the meantime, you can check out <a href='http://www.furnitureassist.com'>our website</a> for more ways to help out.</p>
			<br><br>
			Thanks again,<br>
			Daniel Yost <br>
			Furniture Assist Web Designer";
		
		$subject_admin="A new volunteer has signed up";
		$message_admin=$_POST["full_name"]."<br>".
			$_POST["email_address"]."<br><br>".
			"Positions of Interest:<br>";
			
			foreach($_POST["$interests"] as $elem){
				$message_admin = $message_admin."&emsp;<br>".htmlspecialchars($elem);
			};
	}
	
	//if it was a donation...
	if(array_key_exists("item_name", $_POST)){
		$subject="Thank you for donating!";
		$message=$message.
			"<h2>Your donation is currently being processed.</h2><br>
			Item Name:".$_POST["$item_name"].
			"Item Description:".$_POST["$item_description"].
			"Validation Code:".$_POST["$validation"].
			"<br><br>
			Thank you,<br>
			Daniel Yost <br>
			Furniture Assist Web Designer";
		
		$subject_admin="A new donation has been made";
		$message_admin=$_POST["full_name"]."<br>".
			$_POST["email_address"]."<br><br>".
			"Item Name:".$_POST["$item_name"].
			"Item Description:".$_POST["$item_description"].
			"Validation Code:".$_POST["$validation"];
	}
	
	//if it was an agency..
	if(array_key_exists("agency_name", $_POST)){
		$subject="Thank you for applying for approval!";
		$message=$message.
			"<h2>Your registration for ".$_POST["$agency_name"]." is currently being processed.</h2>".
			"<p>A member of the Furniture Assist team should reach out to you within the month.</p>".
			"<br><br>
			Thank you,<br>
			Daniel Yost <br>
			Furniture Assist Web Designer";
		
		$subject_admin="A new agency has applied";
		$message_admin=$_POST["full_name"]."<br>".
			$_POST["email_address"]."<br><br>".
			"Agency Name:".$_POST["$agency_name"].
			"Agency Website:".$_POST["$agency_website"];
	}
	
	//send the emails
	mail($to, $subject, wordwrap($message, 70, "<br>"), $headers);
	mail($to_admin, $subject_admin, wordwrap($message_admin, 70, "<br>"), $headers_admin);
}

function printTable(){
	global $sql_hostname, $sql_username, $sql_password, $database_name, $table_name, $con;
	
	$columns = mysqli_query($con, "SHOW COLUMNS FROM $table_name");
		
	echo "<table>";
	
	echo "<tr>";
	
	while($row = mysqli_fetch_array($columns)){
		echo "<th>".$row['Field']."</th>";
	}
	
	echo "</tr>";
	
	$result = mysqli_query($con, "SELECT * FROM $table_name");
	
	while($row = mysqli_fetch_row($result)){
		echo "<tr>";
		foreach($row as $member){
			echo "<td>".$member.",</td>";
		}
		echo "</tr>";
	}
	
	echo "</table>";
}

function cullTable($case){
	global $sql_hostname, $sql_username, $sql_password, $database_name, $table_name, $con;
	
	mysqli_query($con, "DELETE FROM $table_name WHERE $case");
}

function quit($new_location){
	global $sql_hostname, $sql_username, $sql_password, $database_name, $table_name, $con;
	
	mysqli_close($con);
	header("Location:$new_location");
}
?>