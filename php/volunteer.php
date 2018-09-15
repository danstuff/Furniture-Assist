<!DOCTYPE html>
<html>
<body>

Redirecting...

<?php 
include('php_base/table.php');

$table_name = "volunteer";

connectTable("volunteer",
	"full_name VARCHAR(30) NOT NULL,
	email_address VARCHAR(50) NOT NULL,
	interests VARCHAR(200)");

newTableEntry(array("full_name", "email_address", "interests"));
										
//emailTableEntry();

quit("/index.htm");
?>
 
</body>
</html>