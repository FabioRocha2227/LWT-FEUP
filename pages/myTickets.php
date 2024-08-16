<?php 
  declare(strict_types=1);

  require_once('../utils/session.php');
  require_once('../database/connection.db.php');
  require_once('../database/ticket.class.php');
  require_once('../database/user.class.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_myTickets.php');

  $session = new Session();
  $db = getDatabaseConnection();
  
  draw_header($session);
  draw_menu($db);
  draw_myTicket($db);
  draw_footer();
?>