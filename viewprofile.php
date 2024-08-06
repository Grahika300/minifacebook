<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Profile - WAPH</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <div class="view-profile-card">
      <h1>View User Profile - WAPH</h1>
      <div id="digit-clock"></div>

      <?php
      session_start();
      require "database.php";

      if (isset($_SESSION['username'])) {
        $userProfile = fetchUserProfile($_SESSION['username']);

        if ($userProfile) {
          ?>
          <form name="viewProfileForm" action="#" method="GET" class="form view-profile">
            <div class="input-group">
              <label for="username">Username:</label>
              <input type="text" class="text_field" name="username" value="<?= htmlentities($userProfile['username']) ?>" readonly />
            </div>
            <div class="input-group">
              <label for="fullName">Full Name:</label>
              <input type="text" class="text_field" name="fullName" value="<?= htmlentities($userProfile['fullname']) ?>" readonly>
            </div>
            <div class="input-group">
              <label for="email">Email:</label>
              <input type="email" class="text_field" name="email" value="<?= htmlentities($userProfile['otheremail']) ?>" readonly>
            </div>
            <div class="input-group">
              <label for="phoneNumber">Phone Number:</label>
              <input type="tel" class="text_field" name="phoneNumber" value="<?= htmlentities($userProfile['phone']) ?>" readonly>
            </div>
          </form>
          <?php
        } else {
          echo '<p>No profile found for the current user.</p>';
        }
      } else {
        echo '<p>User is not logged in.</p>';
      }
      ?>

      <form id="editUserForm" action="edituser.php" method="POST">
        <input type="hidden" name="username" value="<?= isset($_SESSION['username']) ? htmlentities($_SESSION['username']) : '' ?>">
        <button class="button" type="submit">Edit Profile</button>
      </form>
      <form action="index.php" method="POST">
        <button class="button" type="submit">Go Back</button>
      </form>
    </div>
  </div>
</body>
</html>
