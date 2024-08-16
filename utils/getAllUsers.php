<?php 
  declare(strict_types=1);

  require_once('../utils/session.php');
  require_once('../database/user.class.php');
  require_once('../database/connection.db.php');

  $session = new Session();
  $db = getDatabaseConnection();

  $searchTerm = $_GET['searchTerm'];
  $usernames = User::getAllUsernames($db);

  $filteredUsernames = array_filter($usernames, function($username) use ($searchTerm) {
    return stripos($username, $searchTerm) !== false;
  });

  header('Content-Type: application/json');
  echo json_encode(array_values($filteredUsernames));
?>