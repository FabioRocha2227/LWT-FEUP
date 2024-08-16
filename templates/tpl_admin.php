<?php function draw_admin() { ?>
  <!DOCTYPE html>
  <head>
    <title>Admin - Trouble Ticket Management System</title>
    <link rel="stylesheet" type="text/css" href="../css/pages.css">
  </head>

  <body>
    <main>
    <article id="main" class="main">
      <?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
      <?php } ?>
      <h2>Admin actions</h2> <br>
      <section>
        <input type="text" id="searchInput" autocomplete="off" placeholder="Search for users...">

        <div id="resultsPopup" class="popup">
          <h2>Search Results</h2>
          <ul id="resultsList"></ul>
        </div>
      
      <script src="../js/userSearch.js"></script>
      </section>
      <section>
          <h3>Departments</h3>
          <form action="../actions/action_create_department.php" method="post" class="admin">
            <label for="department">Department:</label>
            <input type="text" name="department" required>
            <button type="submit">Add Department</button>
          </form>
      </section>
      
      </article>
  </main>
  </body>
<?php } ?>


