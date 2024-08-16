<?php function draw_report($db) { ?>
  <!DOCTYPE html>
  <head>
    <title>Agent - Trouble Ticket Management System</title>
    <link rel="stylesheet" href="../css/pages.css">
  </head>

  <body>
    <main>
    <article class="main" id="main">
    <section>
        <h2>Filter Tickets</h2>
        <form action="../actions/action_filter_ticket.php" method="GET">
          <label for="filterDirection">Filter By Date:</label>
          <select id="filterDirection" name="filterDirection">
            <option value="asc">Ascending</option>
            <option value="desc">Descending</option>
          </select>
          <button type="submit">Filter</button>
        </form>
      </section>
      <section>
        <h3>Tickets</h3>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Subject</th>
              <th>Title</th>
              <th>Status</th>
              <th>Last Updated</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <p><?php Ticket::display_agent_ticket_list($db) ?></p>
          </tbody>
        </table>
      </section>
    </main>
  </body>
<?php } ?>
