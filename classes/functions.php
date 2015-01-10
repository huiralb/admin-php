<?php 
	function getCurrentURL($removeFileName = true){

		// $currentURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
		// $currentURL .= $_SERVER["SERVER_NAME"];

		// if($_SERVER["SERVER_PORT"] != "80" && $_SERVER["SERVER_PORT"] != "443"){
		// 	$currentURL .= ":".$_SERVER["SERVER_PORT"];
		// }

		$currentURL .= $_SERVER["REQUEST_URI"];

		while(substr($currentURL, -1) == '/'){
			$currentURL = substr($currentURL, 0, -1);
		}

		if($removeFileName){
			$exp = explode('/', $currentURL);
			array_pop($exp);
			$currentURL = implode('/', $exp);
		}

		$currentURL = substr($currentURL, strlen(__DIR__));

		return $currentURL;
	};
 ?>