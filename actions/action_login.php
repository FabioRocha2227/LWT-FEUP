<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');
  require_once('../database/connection.db.php');
  require_once('../database/user.class.php');
  
  $session = new Session();
  $db = getDatabaseConnection();
  $uname = $_POST['username'];
	$pass = $_POST['password'];

  $user = User::getUserWithPassword($db,$pass);
  
  if (empty($uname)) {
		header("Location: ../pages/login.php?error=User Name is required");
	  exit();
	}
  else if(empty($pass)){
    header("Location: ../pages/login.php?error=Password is required");
	  exit();
  }
  else if ($user) {
    $session->setuserID($user->userID);
    $session->setUsername($user->username);
    header("Location: ../pages/createTicket.php");
    exit();
  } 
  else {
    header("Location: ../pages/login.php?error=Incorect User name or password");
    exit();
  }
?>