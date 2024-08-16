<?php function draw_chat($db, Ticket $ticket, User $user) { ?>
  <!DOCTYPE html>

  <html>
  <head>
    <title>Chat Room</title>
    <link rel="stylesheet" href="../css/pages.css">
  </head>
  <body>
    <main>
      <div id="chat-window">
        <div id="chat-messages">
          <div class="message user-message">
            <h3>Ticket description</h3>
            <p><?php echo $ticket->description ?></p>
            <span class="timestamp"><?php echo User::getUsername($ticket->userID, $db) . " - " . $ticket->date ?></span>
          </div>
          <?php Comment::display_comments($db, $ticket, $user) ?>
        </div>
        <div id="chat-input" class="chat-input">
          <form action='../actions/action_add_comment.php' method='post'>
            <input type='hidden' name='ticketId' value="<?php echo $ticket->ticket_id; ?>">
            <input type='text' name='message-input' placeholder='Digite sua mensagem' required>
            <button class='chat-button' id='send-button'>Send</button>
          </form>
          <?php echo "
            <a href='../pages/ticket.php?id=$ticket->ticket_id'> 
            <button class='chat-button' id='back-button'>Back</button>
            </a>
          "?>
        </div>
      </div>
    </main>
  </body>
</html>

<?php } ?>