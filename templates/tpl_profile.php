<?php function drawEditProfileForm(User $user, Session $session) { ?>
  <!DOCTYPE html>
  <head>
    <link rel="stylesheet" href="../css/pages.css">
  </head>
  <body>
    <main class="profileBody">
      <h1>Profile</h1>
      <form action="../actions/action_edit_profile.php" method="post" class="profile">
        <?php if (isset($_GET['error'])) { ?>
          <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>

        <label class="profileLabel2" for="username">Username:</label>
        <input id="username" type="text" name="username" value="<?=$user->username?>">
        <br>

        <label class="profileLabel2"  for="name">First Name:</label>
        <input id="name" type="text" name="name" value="<?=$user->name?>">
        <br>

        <label class="profileLabel2"  for="surname">Last Name:</label>
        <input id="surname" type="text" name="surname" value="<?=$user->surname?>">
        <br>
        
        <label class="profileLabel2"  for="email">Email:</label>
        <input id="email" type="text" name="email" value="<?=$user->email?>">
        <br>

        <label class="profileLabel2"  for="date_of_birth">Date of Birth:</label>
        <input id="date_of_birth" type="date" name="date_of_birth" >
        <br>

        <label class="profileLabel2"  for="gender">Gender:</label>
        <div class="container">
            <input type="radio" id="gender" name="gender" value="Not Specified" >
            <label class="profileLabel2"  for="Not Specified">Not Specified</label>

            <input type="radio" id="gender" name="gender" value="Male">
            <label class="profileLabel2"  for="Male">Male</label>
            
            <input type="radio" id="gender" name="gender" value="Female">
            <label class="profileLabel2"  for="Female">Female</label>
            
            <input type="radio" id="gender" name="gender" value="Other">
            <label class="profileLabel2"  for="Other">Other</label>
            <br>
         </div>   
        <button type="submit">Save</button>
      </form>
    </main>
  </body>
<?php } ?>

<?php function drawProfileForm(User $user) { ?>
  <!DOCTYPE html>
  <head>
    <link rel="stylesheet" href="../css/pages.css">
  </head>
  <body>
    <main class="profileBody" id="profileContainer">
      <h1>Profile</h1>
      <form class="profile">

        <label class="profileLabel" for="username">Username:</label>
        <p> <?php echo $user->username; ?> </p>

        <label class="profileLabel" for="name">First Name:</label>
        <p> <?php echo $user->name; ?> </p>

        <label class="profileLabel" for="surname">Last Name:</label>
        <p> <?php echo $user->surname; ?> </p>

        <label class="profileLabel" for="age">Age:</label>
        <p> <?php echo $user->age; ?> </p>
        
        <label class="profileLabel" for="email">Email:</label>
        <p> <?php echo $user->email; ?> </p>

        <label class="profileLabel" for="gender">Gender:</label>
        <p> <?php echo $user->gender; ?> </p>

        <input class="buttonprofile" type="button" onclick="window.location.href='editprofile.php'" value="Edit Profile" />
      </form>
    </main> 
  </body>

<?php } ?>

<?php function drawProfileForm_Admin(User $user, $db, $department) { ?>
  <!DOCTYPE html>
  <head>
    <link rel="stylesheet" href="../css/pages.css">
  </head>
  <body>
    <main class="profileBody" id="profileContainer">
      <h1>Profile</h1>
      <form class="profile" action="../actions/action_role_dep_change.php">
        <input type="hidden" name="userID" value="<?php echo $user->userID; ?>">

        <label class="profileLabel" for="username">Username:</label>
        <p> <?php echo $user->username; ?> </p>

        <label class="profileLabel" for="name">First Name:</label>
        <p> <?php echo $user->name; ?> </p>

        <label class="profileLabel" for="surname">Last Name:</label>
        <p> <?php echo $user->surname; ?> </p>

        <label class="profileLabel" for="age">Age:</label>
        <p> <?php echo $user->age; ?> </p>
        
        <label class="profileLabel" for="email">Email:</label>
        <p> <?php echo $user->email; ?> </p>

        <label class="profileLabel" for="gender">Gender:</label>
        <p> <?php echo $user->gender; ?> </p>

        <label class="profileLabel" for="roleDisp">Role:</label>
        <p> <?php 
        if ($user->isAdmin === 1) echo 'Admin'; 
        elseif ($user->isAgent === 1) echo 'Agent';
        else echo 'Client'; ?> 
        </p>

        <?php if (User::isAgent($user->userID, $db) === 1) { ?>
        <label class="profileLabel" for="departmentDisp">Department:</label>
        <p> <?php User::getUserDepartment($user->userID, $db); ?> </p>
        <?php } ?>

        <?php if (User::isAdmin($_SESSION['userID'], $db) === 1) { ?>
          <?php 
            echo '<label class="profileLabel" for="department">Change Department</label>';
            echo '<select id="department" name="department" required>';
            echo '<option value="">Please select</option>';
            foreach ($department as $row) {
              echo '<option value="' . $row->department . '">' . $row->department . '</option>';
            }
            echo '</select>';
          ?>
          <?php 
            echo '<label class="profileLabel" for="role">Change Role</label>';
            echo '<select id="role" name="role" required>';
            echo '<option value="">Please select</option>';
            echo '<option value="Client">Client</option>';
            echo '<option value="Agent">Agent</option>';
            echo '<option value="Admin">Agent/Admin</option>';
            echo '</select>';
          ?>
        <?php } ?>
        <button type="submit" class="chat-button" id="send-button">Submit</button>
      </form>
    </main> 
  </body>

<?php } ?>