<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffe</title>
    <link rel="stylesheet" href="css/message.css">
    <link rel="stylesheet" href="css/main.css">

</head>

<!-- Navbar -->

<body>
    <header>
        <nav class="navbar">
            <ul class="nav-links">
                <li><a href="index.php" >HOME</a></li>
                <li><a href="menu.php">MENU</a></li>
                <li><a href="message.php" id="active">SEND A MESSAGE</a></li>

            </ul>
            <div class="logo">
                <img src="img/Logo.png" alt="Daisy Logo">
                <h1>DAISY</h1>
            </div>
            <ul class="nav-links">
                <li><a href="about.php">ABOUT</a></li>
                <li><a href="events.php">EVENTS</a></li>
                <li><a href="contactus.php">CONTACT US</a></li>
            </ul>
        </nav>
    </header>

    <!--Pjesa mas navbar-->

    <div class="contact-container">
        <div class="contact-left">
            
            <h1>Contact Us</h1>
            <p>You will hear from us at the earliest!</p>
            <div class="contact-info">
                <div class="info-item">
                    <span class="icon"></span>
                    <p><strong>Address:</strong>Prishtine, Dradani</p>
                </div>
                <div class="contact-info">
                    <div class="info-item">
                        <span class="icon"></span>
                        <p><strong>Phone:</strong>+38344773732</p>
                    </div>
                    <div class="info-item">
                        <span class="icon"></span>
                        <p><strong>Email:</strong>daisycafe@gmail.com</p>
                    </div>
                   
                </div>

                <div class="contact-right">
                    <form method="POST" action="php/contactController.php">
                    
                        <h2>Send Message</h2>
                        <input type="text"   id="fname" name="name" placeholder="Full Name" required>
                        <input type="email" id="email" name="email" placeholder="Email" required>
                        <textarea id="message" name="message" placeholder="Type Your Message..." required></textarea>
                        <button type="submit" id="send-btn" name="contact_us">Send Message</button>
                        
                    </form>
                </div>
               
            </div>
        </div>
    </div>

    <script src="javascript/message.js"></script>


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






