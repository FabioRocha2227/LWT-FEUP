<?php
declare(strict_types = 1);

require_once('../utils/session.php');
require_once('../database/connection.db.php');
require_once('../database/ticket.class.php');
require_once('../database/user.class.php');
include_once('../templates/tpl_common.php');
include_once('../templates/tpl_filtered.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $session = new Session();
  $db = getDatabaseConnection();
  $filterDirection = $_GET['filterDirection'];
  $query1 = 'SELECT * FROM Ticket WHERE (userID = :userID OR agentID = :userID)'; //if agent
  $query2 = 'SELECT * FROM Ticket'; //if admin
  $id = intval($_SESSION['userID']);

  if ($filterDirection == 'asc') {
    $query1 .= ' ORDER BY date ASC';
    $query2 .= ' ORDER BY date ASC';
  } elseif ($filterDirection == 'desc') {
    $query1 .= ' ORDER BY date DESC';
    $query2 .= ' ORDER BY date DESC';
  }

  if(User::isAdmin($id, $db) === 1) {
    $stmt = $db->prepare($query2);
    $stmt->execute();
  } else {
    $stmt = $db->prepare($query1);
    $stmt->bindParam(':userID', $id);
    $stmt->execute();
  }

  $tickets = [];

  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $ticketID = $row["ticket_id"];
    $department = $row["department"];
    $title = $row["title"];
    $status = $row["status"];
    $date = $row["date"];

    $tickets[] = [
      'ticketID' => $ticketID,
      'department' => $department,
      'title' => $title,
      'status' => $status,
      'date' => $date
    ];
  }
}

  draw_header($session);
  draw_menu($db);
  draw_filtered_tickets($tickets)
?>
