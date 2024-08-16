<?php 
  declare(strict_types = 1);

  require_once('../utils/session.php');
  require_once('../database/user.class.php');
  require_once('../database/ticket.class.php');
  require_once('../database/comment.class.php');
  require_once('../database/connection.db.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_chat.php');

  $session = new Session();
  $db = getDatabaseConnection();
  $ticket_id = intval($_GET['id']);
  $ticket = Ticket::getTicket($db, $ticket_id);
  $user = User::getUser($db);

  draw_header($session);
  draw_menu($db);
  draw_chat($db, $ticket, $user);
  draw_footer();


?>