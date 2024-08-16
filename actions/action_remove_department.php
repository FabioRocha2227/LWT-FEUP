<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');
  require_once('../database/connection.db.php');
  require_once('../database/department.class.php');

  $session = new Session();
  $db = getDatabaseConnection();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $departmentId = $_POST['id'];
        $department = new Department($departmentId);
        $department->remove_department($db);
        header('Location: ../pages/admin.php?removed?success');
        exit();
    }
  }  
?>

