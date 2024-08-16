<?php 
  declare(strict_types = 1);

  require_once('../utils/session.php');
  require_once('../database/connection.db.php');
  require_once('../database/department.class.php');
  require_once('../database/user.class.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_admin.php');
  include_once('../templates/tpl_departments.php');

  $session = new Session();
  $db = getDatabaseConnection();
  $department = Department::getDepartments($db);

  draw_header($session);
  draw_menu($db);
  draw_admin();
  draw_departments($department);
  draw_footer();  

?>