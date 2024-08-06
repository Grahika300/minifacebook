<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Post</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <div class="card">
      <?php
      require "sessionauthentication.php";
      require "database.php";

      if (!isset($_POST['postID']) || !isset($_POST['postContent'])) {
          echo "<h2>Error</h2><p>Post ID or content not provided.</p>";
          die();
      }

      $postID = $_POST['postID'];
      $postContent = htmlspecialchars($_POST['postContent']);

      if (updatePost($postID, $postContent)) {
          echo "<h2>Success</h2><p>Post updated successfully.</p>";
      } else {
          echo "<h2>Error</h2><p>Failed to update post.</p>";
      }

      header("Refresh:2; url=viewposts.php");
      ?>
    </div>
  </div>
</body>
</html>
