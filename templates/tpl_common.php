<?php function draw_header(Session $session) { ?>
  <!DOCTYPE html>
  <head>
    <link rel="stylesheet" href="../css/common.css">
  </head>
  <body>
  <header>
  <div id="signup" class="signup">  

    <h1>The FEUP Ticket Hub</h1>
      <?php 
        if ($session->isLoggedIn()) drawLogoutForm($session);
        else {
          header("Location: ../pages/login.php?error=Session Expired");
        } ;
      ?>
    </div>
  </header>  
  </body>
<?php } ?>

<?php function draw_menu($db) { ?>
  <!DOCTYPE html>
  <head>
    <link rel="stylesheet" href="../css/common.css">
  </head>

  <body>
  <nav class="menu">
        <ul>
          <li><a href="createTicket.php">Submit a Ticket</a></li>
          <li><a href="myTickets.php">My Tickets</a></li>
          <?php 
            if (User::isAgent($_SESSION['userID'], $db) === 1)
              echo "<li><a href='../pages/report.php'>Reports</a></li>";
          ?>
          <?php 
            if (User::isAdmin($_SESSION['userID'], $db) === 1)
              echo "<li><a href='../pages/admin.php'>Admin</a></li>";
          ?>
        </ul>
      </nav>
  </body>
<?php } ?>

<?php function drawLogoutForm(Session $session) { ?>
  <!DOCTYPE html>
  <head>
    <link rel="stylesheet" href="../css/common.css">
  </head>
  <form action="../actions/action_logout.php" method="post" class="logout">
    <a href="../pages/profile.php">Welcome, <?=$session->getUsername()?></a>
    <button class="logoutbutton" type="submit">Logout</button>
  </form>
<?php } ?>


<?php function draw_footer() { ?>
  <!DOCTYPE html>
  <head>
    <link rel="stylesheet" href="../css/common.css">
  </head>
  <body>
  <footer id="footer">
      <p>&copy;The FEUP Ticket Hub. All rights reserved.</p>
      <p><a href="../pages/faq.php">FAQ</a></p>
    </footer>
  </body>
<?php } ?>

