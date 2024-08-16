<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');
  require_once('../database/connection.db.php');
  require_once('../database/user.class.php');
  
  $session = new Session();
  $db = getDatabaseConnection();
  $username = $_POST['username'];
  $pass = $_POST['password'];
  $pass2 = $_POST['passwordRepeat'];
  $email = $_POST['email'];

  if (empty($username)) {
    header("Location: ../pages/register.php?error=User Name is required");
    exit();
  }
  else if(empty($pass)){
    header("Location: ../pages/register.php?error=Password is required");
    exit();
  }
  else if (empty($pass2)) {
    header("Location: ../pages/register.php?error=Type your password again");
    exit();
  }
  else if(empty($email)){
    header("Location: ../pages/register.php?error=Email is required");
    exit();
  }
  else if(strcmp($pass, $pass2) != 0){
    header("Location: ../pages/register.php?error=Passwords do not match");
    exit();
  }
  else if(User::checkUsername($db)) {
    header("Location: ../pages/register.php?error=Username already in use");
    exit();
  }
  else if(User::checkEmail($db)) {
    header("Location: ../pages/register.php?error=Email already in use");
    exit();
  }
  else {
    User::saveUser($db);
    header("Location: ../pages/login.php?error=Registration was a success, you can now login");
    exit();
  }
?>