<?php
  
  require (__DIR__.'/../classes/Db.class.php');

  $username = $_POST['name'];
  $password = $_POST['password'];
  $submit   = $_POST['submit'];

  // $username = "admin";
  // $password = "qwalitaz1";
  $msg = "";
  if ( isset($username) && isset($password) ) {
    $db = new Db();
    $db->bind("username", $username);
    $db->bind("password", $password); 
    $row = $db->query(" SELECT * FROM admin WHERE username = :username AND password = :password ");

    if($username == $row[0]['username']) {
      session_start();
      $_SESSION['username']       = $username;
      $_SESSION['type']           = $row[0]['type'];
      $_SESSION['displayname']    = $row[0]['displayname'];
      $_SESSION['start']          = time();
      $_SESSION['expired']        = $_SESSION['start'] + ( 120 * 60 ); // 30 menit
      
      header("location:../dashboard.php");
      if ($_SESSION['type'] == 'P') {
        header("location:../person.php");
      }
      
    }else{
      $msg = "Wrong+Username+or+Password";
      header("location:../index.php?error=1&msg=$msg");
    }

  }else{
    echo "please insert username and password";
  }
?>