<?php
	session_start();
	  $username 			= $_SESSION['username'];
	  $type     			= $_SESSION['type'];
	  if (!isset($username)) {
	    	header("location:index.php");
	  }else{	  	
		  $now  = time();
		  if ($now > $_SESSION['expired']) {
		    session_destroy();
		    header("location:index.php?redirect=true");
		  }
	  }
 ?>