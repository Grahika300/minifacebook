<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Form</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <div class="card">
      <h2>New User Registration</h2>
      <div id="digit-clock"></div>
      <form name="registrationForm" action="addnewuser.php" method="POST" class="form login" onsubmit="return validateForm();">
        <div class="input-group">
          <label for="username">Username:</label>
          <input type="text" class="text_field" name="username" id="username" required placeholder="Username">
          <div id="username-error" class="error-message">Username is required</div>
        </div>
        <div class="input-group">
          <label for="fullName">Full Name:</label>
          <input type="text" class="text_field" name="fullName" id="fullName" required>
          <div id="fullName-error" class="error-message"></div>
        </div>
        <div class="input-group">
          <label for="email">Email:</label>
          <input type="email" class="text_field" name="email" id="email" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Please enter a valid email address" placeholder="example@mail.com" onchange="validateEmail(this);">
          <div id="email-error" class="error-message">Invalid email format</div>
        </div>
        <div class="input-group">
          <label for="password">Password:</label>
          <input type="password" class="text_field" name="password" id="password" required onchange="validatePassword(this);">
          <div id="password-error" class="error-message"></div>
        </div>
        <div class="input-group">
          <label for="confirmPassword">Confirm Password:</label>
          <input type="password" class="text_field" name="confirmPassword" id="confirmPassword" required onchange="validatePasswordMatch(this);">
          <div id="confirmPassword-error" class="error-message">Passwords do not match</div>
        </div>
        <div class="input-group">
          <label for="phoneNumber">Phone Number:</label>
          <input type="tel" class="text_field" name="phoneNumber" id="phoneNumber" required pattern="[0-9]{10}" title="Please enter a 10-digit phone number" onchange="validatePhoneNumber(this);">
          <div id="phoneNumber-error" class="error-message">Invalid phone number format</div>
        </div>
        <button class="button" type="submit">Register</button>
        <button class="button" onclick="window.location.href='form.php';">Go back</button>
      </form>
    </div>
  </div>
  <script>
    function validateEmail(input) {
      var isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(input.value);
      var errorElement = document.getElementById("email-error");
      if (!isValid) {
        errorElement.style.display = "block";
      } else {
        errorElement.style.display = "none";
      }
    }

    function validatePhoneNumber(input) {
      var isValid = /^\d{10}$/.test(input.value);
      var errorElement = document.getElementById("phoneNumber-error");
      if (!isValid) {
        errorElement.style.display = "block";
      } else {
        errorElement.style.display = "none";
      }
    }

    function validatePassword(input) {
      var password = input.value;
      var errorElement = document.getElementById("password-error");

      var strongPasswordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^\da-zA-Z])(?!.*\s).{8,}$/;

      if (!strongPasswordRegex.test(password)) {
        errorElement.textContent = "Password must be at least 8 characters and include a number, lowercase letter, uppercase letter, and a symbol";
        errorElement.style.display = "block";
      } else {
        errorElement.style.display = "none";
      }
    }

    function validatePasswordMatch(input) {
      var password = document.getElementById("password").value;
      var confirmPassword = input.value;
      var errorElement = document.getElementById("confirmPassword-error");
      if (password !== confirmPassword) {
        errorElement.style.display = "block";
      } else {
        errorElement.style.display = "none";
      }
    }

    function validateForm() {
      var isValid = true;
      var inputs = document.querySelectorAll("input");
      inputs.forEach(function(input) {
        if (!input.checkValidity()) {
          isValid = false;
          input.reportValidity();
        }
      });
      return isValid;
    }
  </script>
</body>
</html>
