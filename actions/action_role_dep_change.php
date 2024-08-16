<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');
  require_once('../database/connection.db.php');
  require_once('../database/user.class.php');

  $session = new Session();
  $db = getDatabaseConnection();
  $role = $_GET['role'];
  $department = $_GET['department'];
  $userID = intval($_GET['userID']);

  User::changeRole($db, $role, $department, $userID);
  
  header("Location: ../pages/admin.php");
?>