<?php 
	if(!defined('IN_CODE'))
		die();
	
	define('ADMIN_USER_HASH', 'dd7aea30832a6e38cb458ff4aa069e3a');
	define('ADMIN_PASS_HASH', 'eebed6cc06c21dca4f1347d42be70eca');
	
	function validate($username, $password){
		return (md5($username) == ADMIN_USER_HASH && md5($password) == ADMIN_PASS_HASH);
	}
?>