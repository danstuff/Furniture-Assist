<!DOCTYPE html>
<html>
<body>

Redirecting...

<?php 
include('php_base/table.php');

connectTable("donation",
	"full_name VARCHAR(30) NOT NULL,
	email_address VARCHAR(50) NOT NULL,
	item_name VARCHAR(30) NOT NULL,
	item_description VARCHAR(100) NOT NULL,
	validation_code VARCHAR(4) NOT NULL");

newTableEntry(array("full_name", "email_address", "item_name", "item_description",
					"validation_code"));
									
//emailTableEntry();
	
quit("/index.htm");
?>
 
</body>
</html>