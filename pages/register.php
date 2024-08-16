<?php
  declare(strict_types=1);
  
  require_once('../utils/session.php');
  require_once('../templates/tpl_auth.php');
  require_once('../database/connection.db.php');

  $session = new Session();
 
  draw_register($session);

?>