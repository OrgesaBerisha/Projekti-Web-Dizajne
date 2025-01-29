<?php
session_start();
include_once 'Database.php';
include_once 'User.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new Database();
    $connection = $db->getConnection();
    $user = new User($connection);

    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($user->login($username, $password)) {
        header("Location: menu.php");
        exit;
    } else {
        echo "Invalid login credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/contactus.css">
</head>

<body>

  <!--NavBar-->
  <header>
    <nav class="navbar">
      <ul class="nav-links">
        <li><a href="index.php">HOME</a></li>
        <li><a href="menu.php">MENU</a></li>
      </ul>
      <div class="logo">
        <img src="img/Logo.png" alt="Daisy Logo">
        <h1>DAISY</h1>
      </div>
      <ul class="nav-links">
        <li><a href="about.php">ABOUT</a></li>
        <li><a href="events.php">EVENTS</a></li>
        <li><a href="contactus.php" id="active">CONTACT US</a></li>
      </ul>
    </nav>
  </header>

  <!--Log In Page-->
  <main class="main-container">
    <section class="register-section">
      <div class="orders-img-container">
        <img src="./img/orders.png" class="orders-img" />
        <div class="orders-text-container">
          <h1 class="orders-title">Online Ordering</h1>
          <p class="orders-description">
            To make your experience a lot easier, open a new account and have
            your coffee delivered at your door-step or your work
          </p>
        </div>
      </div>
      <div class="register-container">
        <h1 class="register-title">Log In</h1>
        <form class="register-form" method="POST">
          <div class="form-input-container-">
            <div class="input-element">
              <label for="username">Username</label>
              <input class="form-input" type="text" id="userid" name="username" size="15" maxlength="30"
                placeholder="Enter your username" />
            </div>
            <div class="input-element">
              <label for="password">Password</label>
              <input class="form-input" type="password" id="pass" name="password" size="15" maxlength="30"
                placeholder="Enter your password" />
            </div>
          </div>
          <button class="register-button" type="submit" value="Subscribe">
            Log In
          </button>
          <p class="bottom-text">
            Don't have an account? <a class="login-link" href="contactus.php">Sign Up</a>
          </p>
        </form>
      </div>
    </section>

  </main>
  <!--Footer-->
  <footer>
    <div class="footer-content">
      <div class="footer-contact">
        <h4>Contact Us</h4>
        <p>+38344722232</p>
        <p>daisycafe@gmail.com</p>
        <p>PRISHTINE</p>
        <p>DARDANI</p>
      </div>
      <div class="footer-main">
        <p class="footer-line">
          <i>A journey into timeless elegance <br> and modern comfort.</i>
        </p>
        <nav class="footer-nav">
          <a href="index.php">HOME</a>
          <a href="menu.php">MENU</a>
          <a href="about.php">ABOUT US</a>
          <a href="events.php">EVENTS</a>
          <a href="contactus.php">CONTACT US</a>
        </nav>
        <p class="footer-copyright">
          Copyright © 2024 DaisyCafe. All rights reserved.
        </p>
      </div>
  </footer>

  <script src="javascript/login.js"></script>

</body>

</html>
