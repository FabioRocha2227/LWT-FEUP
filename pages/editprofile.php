<?php
  declare(strict_types = 1);

  require_once('../database/connection.db.php');
  require_once('../database/user.class.php');
  require_once('../utils/session.php');
  require_once('../templates/tpl_common.php');
  require_once('../templates/tpl_profile.php');
 
  $session = new session();
  $db = getDatabaseConnection();
  $user = User::getUser($db);

  draw_header($session);
  draw_menu($db);
  drawEditProfileForm($user, $session);
  draw_footer();
?>