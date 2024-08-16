<?php
  declare(strict_types = 1);
    
  require_once('../utils/session.php');
  require_once('../database/connection.db.php');  
  require_once('../database/department.class.php');

  $db = getDatabaseConnection();  
  $session = new Session();
    
  if (Department::checkDepName($db)) {
    header("Location: ../pages/admin.php?error=Department already exists");
    exit();
  }  
  else {
    Department::create_department($db);
    header("Location: ../pages/admin.php");
  }
?>