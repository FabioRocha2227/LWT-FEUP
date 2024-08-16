<?php function draw_myTicket($db) { ?>
  <?php include_once '../database/ticket.class.php'; ?>
  <!DOCTYPE html>
  <head>
    <title>My Tickets - Trouble Ticket Management System</title>
    <link rel="stylesheet" href="../css/pages.css">
  </head>
  <body>
    <main>
    <article class="main" id="main">
    <h2>My Tickets</h2>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Subject</th>
            <th>Title</th>
            <th>Status</th>
            <th>Last Updated</th>
            <th>Assigned Agent</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        <p><?php Ticket::display_ticket_list($db) ?></p>
        </tbody>
      </table>
  </form>
  </main>
  </body> 
<?php } ?>


<?php function draw_ticket($ticket, $db) { ?>
  <!DOCTYPE html>
  <html>
  <head>
    <title>My Tickets - Trouble Ticket Management System</title>
    <link rel="stylesheet" href="../css/pages.css">
  </head>
  <body>
    <main class="ticket-container">
      <div class="ticket-details">
        <h2>TICKET #<?php echo $ticket->ticket_id ?></h2>
        <p><strong class="fixed">User: </strong> <?php echo User::getUsername($ticket->userID, $db) ?></p>
        <p><strong class="fixed">Description: </strong><?php echo $ticket->description ?> </p>
        <p><strong class="fixed">Department: </strong><?php echo $ticket->department ?> </p>
        <p><strong class="fixed">Date: </strong><?php echo $ticket->date ?></p>
        <p><strong class="fixed">State: </strong> <?php echo $ticket->status ?></p>
        <p><strong class="fixed">Agent: </strong> <?php echo User::getUsername($ticket->agentID, $db) ?></p>
        <?php echo "
        <a href='chatRoom.php?id=$ticket->ticket_id'> 
          <button class='open-conversation-btn' >Open Chat</button>
        </a>
        "?>
        <a href="main.php">  
          <button class="open-conversation-btn">Close Ticket</button>
        </a>

        <?php 
        if (User::isAgent($_SESSION['userID'], $db) === 1 OR (User::isAdmin($_SESSION['userID'], $db) === 1)){
        echo "<a href='editTicket.php?id=$ticket->ticket_id'><button class='open-conversation-btn' >Edit Ticket</button></a>";}
        ?>
      </div>
    </main>
  </body>
</html>

<?php } ?>

<?php function draw_editTicket($ticket,$department ,$user,$db) { ?>
  <!DOCTYPE html>
  <head>
    <link rel="stylesheet" href="../css/pages.css">
  </head>
  <body>
    <main class="profileBody">
    <h1>TICKET #<?php echo $ticket->ticket_id ?></h1>
        <form class="profile" action="../actions/action_editTicket.php" method="post">
          <input type="hidden" name="agent_id" value="<?php echo $ticket->agentID ?>">
          <input type="hidden" name="ticekt_id" value="<?php echo $ticket->ticket_id ?>">

          <p><strong class="fixed">User: </strong> <?php echo User::getUsername($ticket->userID, $db) ?></p>
          <p><strong class="fixed">Description: </strong><?php echo $ticket->description ?> </p>

          <label class="fixed" for="selectDep">Department:</label>
          <select id="selectDep" name="selectDep" required>
          <option value="">Please select</option>
          <?php foreach ($department as $row) { ?>
            <option value="<?php echo $row->department; ?>"><?php echo $row->department; ?></option>
          <?php } ?>
          </select>

          <p><strong class="fixed">Date: </strong><?php echo $ticket->date ?></p>

          <label class="fixed" for="selectStatus">Status:</label>
          <select id="selectStatus" name="selectStatus" required>
          <option value="">Please select</option>
            <option value="NEW">NEW</option>
            <option value="ANSWERED">ANSWERED</option>
            <option value="OPEN">OPEN</option>
            <option value="POSTPONED">POSTPONED</option>
            <option value="RESOLVED">RESOLVED</option>
          </select>

          <label class="fixed" for="selectAgent">Agent:</label>
          <select id="selectAgent" name="selectAgent" required>
          <option value="">Please select</option>
          <?php foreach ($user as $row) { ?>
            <option value="<?php echo $row->username; ?>"><?php echo $row->username; ?></option>
          <?php } ?>
          </select>

          <button type="submit" class='open-conversation-btn' >Confirm Changes</button>
         
        </form> 
    </main> 
  </body>

<?php } ?>
