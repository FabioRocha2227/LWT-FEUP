<?php
  declare(strict_types = 1);
  
  require_once('../utils/session.php');
  require_once('../database/connection.db.php');
  require_once('../database/faq.class.php');

  $session = new Session();
  $db = getDatabaseConnection();
  $question = $_POST['question'];
  $answer = $_POST['answer'];

  Faq::addFAQ($db);

  header("Location: ../pages/faq.php");
?>