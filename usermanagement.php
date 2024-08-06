<?php
session_start();

require_once "database.php"; 

// Check if the logged-in user is a superuser
$userProfile = fetchUserProfile($_SESSION['username']);
if ($userProfile && $userProfile['superuser'] != 1) {
    echo "<script>alert('Access denied. Only superusers can access this page.');</script>";
    header("Refresh:0; url=index.php");
    die();
}

// Handle enabling or disabling user accounts
if (isset($_POST['action']) && isset($_POST['username'])) {
    $action = $_POST['action'];
    $username = $_POST['username'];
    
    if ($action === 'enable') {
        changeUserStatus($username, 1);
        echo "<script>alert('User account enabled.');</script>";
    } elseif ($action === 'disable') {
        changeUserStatus($username, 0);
        echo "<script>alert('User account disabled.');</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome Page</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0fff0;
    }

    .container {
      text-align: center;
      padding-top: 20px;
    }

    .welcome-text {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .links {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
    }

    .links form {
      margin: 10px;
    }

    .links button {
      padding: 10px 20px;
      font-size: 16px;
      cursor: pointer;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      transition: background-color 0.3s;
    }

    .links button:hover {
      background-color: #0056b3;
    }

    .post-container {
      margin-bottom: 20px;
    }

    .post {
      background-color: #f9f9f9;
      border-radius: 8px;
      padding: 20px;
    }

    .post h3 {
      margin-top: 0;
    }

    .post p {
      margin-bottom: 10px;
    }

    .comment {
      background-color: #f0f0f0;
      border-radius: 4px;
      padding: 10px;
      margin-top: 10px;
    }

    .comment p {
      margin-bottom: 5px;
    }

    .add-comment-form {
      margin-top: 10px;
    }

    .add-comment-form textarea {
      width: calc(100% - 20px);
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      resize: vertical;
      margin-bottom: 10px;
    }

    .add-comment-form input[type="submit"] {
      background-color: #007bff;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .add-comment-form input[type="submit"]:hover {
      background-color: #0056b3;
    }

    /* Adjust home button color */
    button[type="submit"] {
      background-color: #007bff;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    button[type="submit"]:hover {
      background-color: #0056b3;
    }
    
    .edit-delete-container {
      display: inline-block;
    }
    
    .edit-post-form, .delete-post-form {
      display: inline;
    }
  </style>
</head>
<body>
  <div class="container">
      <?php
      echo "<div class='welcome-text'>Welcome " . htmlentities($_SESSION['username']) . "!</div>";
      ?>
      <div class="links">
        <form id="home" action="index.php" method="POST">
          <button type="submit">Home</button>
        </form> 
        <form id="changepasswordform" action="changepasswordform.php" method="POST">
          <input type="hidden" name="username" value="<?php echo urlencode($_SESSION['username']); ?>">
          <button type="submit">Change Password</button>
        </form>
        <form id="viewprofileform" action="viewprofile.php" method="POST">
          <input type="hidden" name="username" value="<?php echo urlencode($_SESSION['username']); ?>">
          <button type="submit">View/Edit Profile</button>
        </form> 
        <form id="addpostform" action="addpost.php" method="POST">
          <button type="submit">Add Post</button>
        </form>
        <form id="logout" action="logout.php" method="POST">
          <button type="submit">Logout</button>
        </form> 
    </div>

    <h1>Users</h1>

    <?php
    // Fetch all users
    $users = $mysqli->query("SELECT * FROM users");

    if ($users->num_rows > 0) {
        while ($row = $users->fetch_assoc()) {
            echo "<div class='user-container'>";
            echo "<p>Username: " . htmlspecialchars($row['username']) . "</p>";
            echo "<p>Fullname: " . htmlspecialchars($row['fullname']) . "</p>";
            echo "<p>Email: " . htmlspecialchars($row['otheremail']) . "</p>";
            echo "<p>Phone: " . htmlspecialchars($row['phone']) . "</p>";
            echo "<p>Status: " . ($row['account_enabled'] == 1 ? "Enabled" : "Disabled") . "</p>";
            
            // Enable/disable user account form
            if ($row['account_enabled'] == 1) {
                echo "<form action='' method='POST'>";
                echo "<input type='hidden' name='action' value='disable'>";
                echo "<input type='hidden' name='username' value='" . $row['username'] . "'>";
                echo "<button type='submit'>Disable Account</button>";
                echo "</form>";
            } else {
                echo "<form action='' method='POST'>";
                echo "<input type='hidden' name='action' value='enable'>";
                echo "<input type='hidden' name='username' value='" . $row['username'] . "'>";
                echo "<button type='submit'>Enable Account</button>";
                echo "</form>";
            }
            
            echo "</div>";
        }
    } else {
        echo "<p>No users found.</p>";
    }
    ?>
  </div>
</body>
</html>

