<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add a New Post</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <div class="card">
      <?php
      require "sessionauthentication.php";
      require "database.php";

      if (isset($_POST['postContent'])) {
          $postContent = htmlspecialchars($_POST['postContent']);
          $username = $_SESSION['username'];

          if (insertPost($postContent, $username)) {
              echo "<h2>Success</h2><p>Post added successfully.</p>";
          } else {
              echo "<h2>Error</h2><p>Failed to add post.</p>";
          }
      } else {
          echo "<h2>Error</h2><p>No post content provided.</p>";
      }
      header("Refresh:2; url=index.php");
      ?>
    </div>
  </div>
</body>
</html>
