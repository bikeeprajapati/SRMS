<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Admin Login</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="css/login/styles.css" />
    <script type="module" src="js/login/script.js"></script>
  </head>
  <body>
    <div class="login-container">
      <form id="loginForm" class="login-form">
        <h2 class="title">Admin Login</h2>
        <div class="form-group">
          <input type="text" id="username" required>
          <label for="username">Username</label>
          <div class="line"></div>
        </div>
        <div class="form-group">
          <input type="password" id="password" required>
          <label for="password">Password</label>
          <div class="line"></div>
        </div>
        <button type="submit" class="login-btn">
          <span>Login</span>
        </button>
        <div id="message" class="message"></div>
      </form>
    </div>
  </body>
</html>