<?php function draw_login(Session $session) { ?>
  <!DOCTYPE html>
  
  <head>
      <title>Login</title>
      <link rel="stylesheet" href="../css/auth.css">
  </head>
  
  <body>
      <div class="login-container">
        <form action="../actions/action_login.php" method="post" class="login">
          <h1 class="sign-in">Sign In</h1>
          <?php if (isset($_GET['error'])) { ?>
     		    <p class="error"><?php echo $_GET['error']; ?></p>
     	    <?php } ?>
              <div class="login-form">
                  <div class="sign-in-htm">
                      <div class="group">
                          <label for="username" class="label">Username</label>
                          <input name="username" id="username" type="username" class="input">
                      </div>
                      <div class="group">
                          <label for="password" class="label">Password</label>
                          <input name="password" id="password" type="password" class="input" data-type="password">
                      </div>
                      <div class="group">
                          <button type="submit" class="button">Login</button>
                      </div>
                      <div class="hr"></div>
                      <div class="foot-lnk">
                          <a href="register.php">Don't have an account? Click here.</a>
                      </div>
                  </div>  
              </div>
          </form>
      </div>
  </body>
<?php } ?>

<?php function draw_register(Session $session) { ?>
  <!DOCTYPE html>
  
  <head>
      <title>Register</title>
      <link rel="stylesheet" href="../css/auth.css">
  </head>

  <body>
  <div class="login-container">
    <form action="../actions/action_register.php" method="post" class="login">
      <h1 class="sign-up">Sign Up</h1>
      <?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
      <div class="login-form"> 
        <div class="sign-up-htm">
          <div class="group">
            <label for="username" class="label">Username</label>
            <input name="username" id="username" type="username" class="input">
          </div>
          <div class="group">
            <label for="password" class="label">Password</label>
            <input name="password" id="password" type="password" class="input" data-type="password">
          </div>
          <div class="group">
            <label for="passwordRepeat" class="label">Repeat Password</label>
            <input name="passwordRepeat" id="passwordRepeat" type="password" class="input" data-type="password">
          </div>
          <div class="group">
            <label for="email" class="label">Email Address</label>
            <input name="email" id="email" type="email" class="input">
          </div>
          <div class="group">
            <button type="submit" class="button">Sign Up</button>
          </div>
          <div class="hr"></div>
          <div class="foot-lnk">
            <a href="login.php">Already Member?</a>
          </div>
      </div>
      </div>
    </form>
  </div>
  </body>
<?php } ?>
