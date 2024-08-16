<?php function draw_createTicket($department) { ?>
  <!DOCTYPE html>
  <head>
    <title>Submit a Ticket - Trouble Ticket Management System</title>
    <link rel="stylesheet" href="../css/pages.css">
  </head>

  <body>
    <main>
    <article class="main"  id="main">
    <h2>Submit a Ticket</h2>
      <form action="../actions/action_create_ticket.php" method="post">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        <label for="category">Department:</label>
        <select id="department" name="department" required>
          <option value="">Please select</option>
          <?php foreach ($department as $row) { ?>
            <option value="<?php echo $row->department; ?>"><?php echo $row->department; ?></option>
          <?php } ?>
        </select>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="5" required></textarea>

        <button class="submitTicket" type="submit">Submit Ticket</button>
      </form>
    </article>
    </main>
  </body>
<?php } ?>
