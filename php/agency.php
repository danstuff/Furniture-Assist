<!DOCTYPE html>
<html>
<body>
 
 Redirecting...
 
<?php 
include('php_base/table.php');

connectTable("agency",
	"full_name VARCHAR(30) NOT NULL,
	email_address VARCHAR(50) NOT NULL,
	phone_number VARCHAR(20) NOT NULL,
	fax_number VARCHAR(20) NOT NULL,
	agency_name VARCHAR(50) NOT NULL,
	agency_website VARCHAR(50) NOT NULL,
	street_address VARCHAR(50) NOT NULL,
	city VARCHAR(30) NOT NULL,
	state VARCHAR(10) NOT NULL,
	zip_code VARCHAR(10) NOT NULL");

newTableEntry(array("full_name", "email_address", "phone_number", "fax_number",
					"agency_name", "agency_website", "street_address", "city",
					"state","zip_code"));
					
//emailTableEntry();
					
quit("/index.htm");
?>
 
</body>
</html>