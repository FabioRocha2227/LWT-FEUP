<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');
  require_once('../database/connection.db.php');
  require_once('../database/ticket.class.php');

  $session = new Session();
  $db = getDatabaseConnection();

  Ticket::create_ticket($db);

  header("Location: ../pages/myTickets.php");
?>