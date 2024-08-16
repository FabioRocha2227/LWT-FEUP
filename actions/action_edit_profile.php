<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');
  require_once('../database/connection.db.php');
  require_once('../database/user.class.php');

  $session = new Session();
  $db = getDatabaseConnection();
  $user = User::getuser($db);
  $username = $_POST['username'];
  $email = $_POST['email'];

  if (empty($username)) {
    header("Location: ../pages/editprofile.php?error=User Name is required");
    exit();
  }
  else if (empty($email)) {
    header("Location: ../pages/editprofile.php?error=Email is required");
    exit();
  }
  else if ($username !== $user->username) {
    if(User::checkUsername($db)) {
      header("Location: ../pages/editprofile.php?error=Username already in use");
      exit();
    }
  }
  else if ($email !== $user->email) {
    if(User::checkEmail($db)) {
      header("Location: ../pages/editprofile.php?error=Email already in use");
      exit();
    }
  }
  
  User::save($db);
  
  header('Location: ../pages/profile.php?error=Changes saved successfully');
?>