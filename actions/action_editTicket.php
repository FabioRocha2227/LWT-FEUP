<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');
  require_once('../database/connection.db.php');
  require_once('../database/user.class.php');
  require_once('../database/department.class.php');
  require_once('../database/ticket.class.php');

  $session = new Session();
  $db = getDatabaseConnection();
  $ticket_id = $_POST['ticekt_id'];
  $agentID = $_POST['agent_id'];
  $agent = $_POST['selectAgent'];
  $dep =$_POST['selectDep'];
  $stat=$_POST['selectStatus'];

  $agentID1 = User::getAgentID2($db,$agent);
  Ticket::editTicket($db, $ticket_id,$stat,$dep, $agentID1);

  header('Location: ../pages/report.php');
?>