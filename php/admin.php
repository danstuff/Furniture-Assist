<!DOCTYPE html>
<html>

<head>
	<!-- basic head information: title, display icon, link to stylesheet/javascript -->
	<title>Furniture Assist</title>
	
	<link rel="stylesheet" type="text/css" href="/css_style/style.css">
	
	<link rel="icon" href="img/icon.png">
	
</head>

<body>
	<canvas id="background"></canvas>
	
	<div class="content"> 
	<div class="content_clear">
	<div class="scalable_content">
	
	<h1>Welcome, fa_admin!</h1>
	
	<?php 
	define( 'IN_CODE', '1');
	include('php_base/config.php');
	
	include('php_base/table.php');
	include('php_base/session.php');
	
	//fetch username and password
	start();
	
	if(existsPost("username") && existsPost("password")){
		//if found in $_POST, set $_SESSION to $_POST
		$username = getPost("username"); 
		$password = getPost("password"); 
		
		set("username", $username);
		set("password", $password);
	}else{
		//if not found in $_POST, try $_SESSION
		$username = get("username");
		$password = get("password");
	}
	
	//quit if logout button was clicked, or u/p was wrong
	if(existsPost("logout") || !validate($username, $password)){
		destroy();		
		quit("/index.htm");
	}
	
	//set table
	if(existsPost("volunteer")){
		set("active_table", "volunteer");
	}
	if(existsPost("donation")){
		set("active_table", "donation");
	}
	if(existsPost("agency")){
		set("active_table", "agency");
	}
	if(existsPost("client")){
		set("active_table", "client");
	}
	
	if(exists("active_table")){
		connectTable(get("active_table"), "");
	}	
	
	//mark as approved/unapproved
	if(existsPost("approve")){
		editTableEntry(getPost("id"), "time_approved=NOW(), approved=1");
	}
	if(existsPost("unapprove")){
		editTableEntry(getPost("id"), "time_approved=NULL, approved=0");
	}
	
	//remove all unapproved
	if(existsPost("cull")){
		echo "<form action='admin.php' method='post'>
			<input type='submit' name='cull_confirm' value='Confirm Remove All Unapproved'/>
			</form>";
	}
	if(existsPost("cull_confirm")){
		cullTable("approved=0");
	}
		
	//print table to the screen
	if(exists("active_table")){
		printTable();

		echo "<br>
			
			<form action='admin.php' method='post'>
				<input type='text' name='id' placeholder='Enter an ID...'/>
				<input type='submit' name='approve' value='Mark as Approved'/>
				<input type='submit' name='unapprove' value='Mark as Unapproved'/>
			</form>
			
			<br><br>
			
			<form action='admin.php' method='post'>
				<input type='submit' name='cull' value='Remove All Unapproved'/>
			</form>
			
			<br><br>";
	}
	?>
	
	<form action="admin.php" method="post">
		<input type="submit" name="volunteer" value="Select Volunteers Table"/>
		<input type="submit" name="donation" value="Select Donations Table"/>
		<input type="submit" name="agency" value="Select Agencies Table"/>
	</form>
	
	<br><br>
	
	<form action="admin.php" method="post">
		<input type="submit" name="logout" id="logout" value="Logout"/>
	</form>

	</div>
	</div>
	</div>

	<script src="/js_script/trianglify.js"></script>
	<script src="/js_script/header.js"></script>
</body>
</html>