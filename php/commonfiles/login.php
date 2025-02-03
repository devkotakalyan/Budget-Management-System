<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="../../CSS/login.css">
  <!-- <script src="../../js/loginvalidation.js"></script> -->
</head>
<body>
  <div class="wrapper">
    <form action="../funct/log.php" method="post">
      <h2>Login</h2>
      
      <!-- Role Selection Dropdown -->
      <div class="input-field">
        <select name="role" required>
          <option value="" disabled selected>Select your role</option>
          <option value="admin">Admin</option>
          <option value="user">User</option>
        </select>
      </div>

      <!-- Username Input -->
      <div class="input-field">
        <input type="text" name="username" required>
        <label>Enter your email</label>
      </div>

      <!-- Password Input -->
      <div class="input-field">
        <input type="password" name="password" required>
        <label>Enter your password</label>
      </div>

      <div class="forget">
        <label for="remember">
          <input type="checkbox" id="remember">
          <p>Remember me</p>
        </label>
        <a href="#">Forgot password?</a>
      </div>
      <button type="submit">Log In</button>
    </form>
  </div>
</body>
</html>
