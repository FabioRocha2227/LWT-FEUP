<?php 
  declare(strict_types=1);

  require_once('../utils/session.php');
  require_once('../database/user.class.php');
  require_once('../database/connection.db.php');
  require_once('../database/faq.class.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_faq.php');

  $session = new Session();
  $db = getDatabaseConnection();
  $question = Faq::getQuestion($db);

  draw_header($session);
  draw_menu($db);
  draw_faq($question);
  draw_footer();

?>