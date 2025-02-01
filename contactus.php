<?php
include_once 'php/Database.php';
include_once 'php/User.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "Form submitted successfully!";
    $db = new Database();
    $connection = $db->getConnection();
    $user = new User($connection);

    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($user->register($name, $username, $email, $password)) {
        header("Location: login.php");
        exit;
    } else {
        echo "Error registering user!";
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
        <li><a href="message.php">SEND A MESSAGE</a></li>
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

  <!--Contact Us Page-->
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
        <h1 class="register-title">Join Us</h1>
        <form class="register-form" method="POST">
          <div class="form-input-container-">
            <div class="input-element">
              <label for="name">Name</label>
              <input class="form-input" type="text" id="name" name="name" size="15" maxlength="30"
                placeholder="Enter your name" />
            </div>
            <div class="input-element">
              <label for="username">Username</label>
              <input class="form-input" type="text" id="userid" name="username" size="15" maxlength="30"
                placeholder="Enter your username of choice" />
            </div>
            <div class="input-element">
              <label for="email">Email</label>
              <input class="form-input" type="email" id="adresaEmail" name="email" placeholder="Enter your email" />
            </div>
            <div class="input-element">
              <label for="password">Password</label>
              <input class="form-input" type="password" id="pass" name="password"
                placeholder="Enter your password of choice" />
            </div>
          </div>
          <button class="register-button" type="submit" value="Subscribe">
            Register
          </button>
          <p class="bottom-text">
            Already have an account? <a class="login-link" href="login.php">Log in</a>
          </p>
        </form>
      </div>
    </section>

  </main>

  <!--Footeri-->
  <footer>
    <div class="footer-content">
      <div class="footer-contact">
        <h4>Contact Us</h4>
        <p>+38344722232</p>
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

  <script src="javascript/contactus.js"></script>

</body>

</html>
