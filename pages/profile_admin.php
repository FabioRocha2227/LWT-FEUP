<?php
  declare(strict_types = 1);

  require_once('../database/connection.db.php');
  require_once('../database/user.class.php');
  require_once('../database/department.class.php');
  require_once('../utils/session.php');
  require_once('../templates/tpl_common.php');
  require_once('../templates/tpl_profile.php');
  
  function generateUserProfileHTML($user, $db, $session, $department) {

    ob_start();
    draw_header($session);
    draw_menu($db);
    drawProfileForm_Admin($user, $db, $department);
    draw_footer();
    $htmlContent = ob_get_clean();
  
    return $htmlContent;
  }

  $session = new session();
  $db = getDatabaseConnection();
  $username = $_GET['username'];
  $user = User::getUserforAdmin($db, $username);
  $department = Department::getDepartments($db);
  
  $htmlContent = generateUserProfileHTML($user, $db, $session, $department);
  echo $htmlContent;
?>