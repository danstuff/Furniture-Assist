<?php 
	function start(){
		session_start();
	}

	function exists($name){
		return array_key_exists($name, $_SESSION);
	}
	function get($name){
		if(exists($name))	
			return htmlspecialchars($_SESSION[$name]); 
		else
			return NULL;
	}
	function set($name, $value){
		$_SESSION[$name] = $value;
	}
	
	function destroy(){
		session_unset();
		session_destroy();
	}
	
	function existsPost($name){
		return array_key_exists($name, $_POST);
	}
	function getPost($name){
		if(existsPost($name))	
			return htmlspecialchars($_POST[$name]); 
		else
			return NULL;
	}	
?>