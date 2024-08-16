<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');
  require_once('../database/connection.db.php');
  require_once('../database/department.class.php');
  
  $session = new Session();
  $db = getDatabaseConnection();

  Department::getDepartments($db);
?>
