<?php
  declare(strict_types=1);

  require_once('../utils/session.php');
  require_once('../database/user.class.php');
  require_once('../database/ticket.class.php');
  require_once('../database/connection.db.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_report.php');

  $session = new Session();
  $db = getDatabaseConnection();

  draw_header($session);
  draw_menu($db);
  draw_report($db);
  draw_footer();


?>