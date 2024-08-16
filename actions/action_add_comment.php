<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');
  require_once('../database/connection.db.php');
  require_once('../database/comment.class.php');
  
  $session = new Session();
  $db = getDatabaseConnection();
  $ticket_id = $_POST['ticketId'];

  Comment::create_comment($db, (int)$ticket_id);

  header("Location: ../pages/chatRoom.php?id=" . $ticket_id);
?>