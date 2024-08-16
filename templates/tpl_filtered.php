<?php
function draw_filtered_tickets($tickets) {
?>
  <!DOCTYPE html>
  <head>
    <title>My Tickets - Trouble Ticket Management System</title>
    <link rel="stylesheet" href="../css/pages.css">
    <link rel="icon" type="image/png" href="../ttms.png">
  </head>
  <body>
  <article id="main">
    <br>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Department</th>
            <th>Title</th>
            <th>Status</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($tickets as $ticket) { 
            $ticketID = $ticket['ticketID'];
            $department = $ticket['department'];
            $title = $ticket['title'];
            $status = $ticket['status'];
            $date = $ticket['date'];

            echo "<tr>";
            echo "<td>$ticketID</td>";
            echo "<td>$department</td>";
            echo "<td>$title</td>";
            echo "<td>$status</td>";
            echo "<td>$date</td>";
            echo "<td><a href='../pages/ticket.php?id=$ticketID'>View</a></td>";
            echo "</tr>";
          }
        echo '</tbody>';
        echo '</table>';?>
        </tbody>
      </table>
    </article>
  </body>
<?php
}
?>