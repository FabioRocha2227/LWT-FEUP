<?php
function draw_departments(array $departments) {
?>
  <!DOCTYPE html>
  <head>
    <title>My Tickets - Trouble Ticket Management System</title>
    <link rel="stylesheet" href="../css/pages.css">
  </head>
  <body>
  <article id="main" class="main">
      <h2 class="depTitle">All Departments</h2>
      <table class="depTable">
        <thead>
          <tr>
            <th>Department</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($departments as $row) { ?>
            <tr>
              <td><?php echo $row->department; ?></td>
              <td>
                <form action="../actions/action_remove_department.php" method="post" class="admin">
                  <input type="hidden" name="id" value="<?php echo $row->department; ?>">
                  <button type="submit">Remove</button>
                </form>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </article>
  </body>
<?php
}
?>
