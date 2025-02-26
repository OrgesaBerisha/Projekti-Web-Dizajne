<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/main.css">

</head>

<!-- Navbar -->

<body>
    <header>
        <nav class="navbar">
            <ul class="nav-links">
                <li><a href="index.php" id="active">HOME</a></li>
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
                <li><a href="contactus.php">CONTACT US</a></li>
            </ul>
        </nav>
    </header>

    <!-- Pjesa mas navbar-->
    <section class="faqja1">
        <div class="faqja1-left">
            <h1 class="faqja1-title">Coffee? Yes, You? maybe </h1>
            <p class="faqja1-description">
                At Daisy, we combine exquisite taste with a sophisticated setting. Each coffee and dish is carefully
                prepared to provide a great experience where elegance and flavor coexist in a setting meant to promote
                happiness and relaxation.
            </p>
        </div>
        <div class="faqja1-right">
            <img src="img/img1.png" alt="Elegant coffee">
        </div>

    </section>

    <!-- Category -->
    <div class="title">Category</div>
    <div class="containerrr">
        <div class="category">
            <img src="img/foto1.png" alt="ICED COFFEE">
            <button class="posht-categoris" onclick="location.href='menu.php'">ICED COFFEE</button>
        </div>
        <div class="category">
            <img src="img/foto5.png" alt="NONE-COFFEE">
            <button class="posht-categoris" onclick="location.href='menu.php'">NONE-COFFEE</button>
        </div>
        <div class="category">
            <img src="img/foto3.png" alt="ESPRESSO COFFEE">
            <button class="posht-categoris" onclick="location.href='menu.php'">ESPRESSO COFFEE</button>
        </div>
        <div class="category">
            <img src="img/foto4.png" alt="ALTERNATIVE MILKS">
            <button class="posht-categoris" onclick="location.href='menu.php'">ALTERNATIVE MILKS</button>
        </div>
        <div class="category">
            <img src="img/foto2.png" alt="SPECIALTY COFFEE">
            <button class="posht-categoris" onclick="location.href='menu.php'">SPECIALTY COFFEE</button>
        </div>

    </div>
    <div class="menu-title">MENU</div>
    <div class="container2">
        <div class="menu-description">
            <h1>Life is better with <br> coffee & food</h1>
        </div>
        <div class="img-content">
            <div class="img-container">
                <img src="img/imggg3.png" alt="coffee and food" class="image-main">
            </div>
            <div class="text-content">
                <h2>Enjoy the perfect blend of flavor</h2>
                <p>We serve only the best coffee and fresh food to satisfy your cravings. Whether you're looking for a quick snack or a delicious meal, we've got you covered!</p>
            </div>
        </div>
     
    
        <section class="description">
            <p>Daisy is a combination of classic flavors and modern designs that makes every meal an unforgettable one!
            </p>
            <button class="seemore-button" onclick="location.href='menu.php'">SEE MORE</button>

        </section>
    </div>

    <!--Container3 AboutUs-->
    <div class="AboutUs-title">ABOUT US</div>
    <div class="text">
        <h1>Welcome to Daisy, the perfect space for a memorable experience</h1>
        <div id="slideshow-container">
            <div id="slideshow-wrapper">
                <button class="slideshow-button prev" onclick="prevImage()"> &gt;</button>
                <img id="slideshow" src="img/shop.png" alt="Slideshow Image">
                <button class="slideshow-button next" onclick="nextImage()">&lt;</button>
            </div>
        </div>
    </div>


    <!--Script per slideshow-->
    <script>
        var imgArray = [
            "img/shop.png",
            "img/shop1.png.png",
            "img/shop2.png.png"

        ];
        var i = 0;

        function showImage() {
            document.getElementById("slideshow").src = imgArray[i];
        }

        function nextImage() {
            if (i < imgArray.length - 1) {
                i++;
            } else {
                i = 0;
            }
            showImage();
        }

        function prevImage() {
            if (i > 0) {
                i--;
            } else {
                i = imgArray.length - 1;
            }
            showImage();
        }


        window.onload = showImage;
    </script>

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













</body>

</html>