<?php
session_start();
require_once 'php/Database.php';
require_once 'php/AdminMenu.php';

$adminMenu = new AdminMenu();
$menuItems = $adminMenu->getAllMenuItems();


class Menu {
    private $db;

    public function __construct() {
        $database = new Database(); 
        $this->db = $database->getConnection(); 
    }

    public function getMenuItems($category) {
        $query = "SELECT * FROM menu_items WHERE category = :category";
        $stmt = $this->db->prepare($query); 
        $stmt->bindParam(':category', $category);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

$menu = new Menu();

$icedCoffee = $menu->getMenuItems('Iced Coffee');
$noneCoffee = $menu->getMenuItems('None Coffee');
$espressoCoffee = $menu->getMenuItems('Espresso Coffee');
$alternativeMilks = $menu->getMenuItems('Alternative Milks');

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/menu.css">
</head>

<body>
    <header>
        <nav class="navbar">
            <ul class="nav-links">
                <li><a href="index.php">HOME</a></li>
                <li><a href="menu.php" id="active">MENU</a></li>
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

    <!--QUOTE -->
    <section class="quote-menu">
        <p class="quote-text">"Good food is the foundation of genuine happiness."</p>
    </section>


    <section class="menu">
        <h2>ICED COFFE</h2>
        <div class="menut">
            <?php foreach ($icedCoffee as $item): ?>
                <div class="menu-item">
                    <img src="<?= $item['image']; ?>" alt="<?= $item['name']; ?>">
                    <h3><?= $item['name']; ?></h3>
                    <p><?= $item['description']; ?></p>
                    <p class="price">$<?= $item['price']; ?></p>
                    <button class="order-btn">Order Now</button>
                </div>
            <?php endforeach; ?>
        </div>

        <h2>NONE COFFE</h2>
        <div class="menut">
            <?php foreach ($noneCoffee as $item): ?>
                <div class="menu-item">
                    <img src="<?= $item['image']; ?>" alt="<?= $item['name']; ?>">
                    <h3><?= $item['name']; ?></h3>
                    <p><?= $item['description']; ?></p>
                    <p class="price">$<?= $item['price']; ?></p>
                    <button class="order-btn">Order Now</button>
                </div>
            <?php endforeach; ?>
        </div>

        <h2>ESSPRESO COFFE</h2>
        <div class="menut">
            <?php foreach ($espressoCoffee as $item): ?>
                <div class="menu-item">
                    <img src="<?= $item['image']; ?>" alt="<?= $item['name']; ?>">
                    <h3><?= $item['name']; ?></h3>
                    <p><?= $item['description']; ?></p>
                    <p class="price">$<?= $item['price']; ?></p>
                    <button class="order-btn">Order Now</button>
                </div>
            <?php endforeach; ?>
        </div>

        <h2>ALTERNATIVE MILKS</h2>
        <div class="menut">
            <?php foreach ($alternativeMilks as $item): ?>
                <div class="menu-item">
                    <img src="<?= $item['image']; ?>" alt="<?= $item['name']; ?>">
                    <h3><?= $item['name']; ?></h3>
                    <p><?= $item['description']; ?></p>
                    <p class="price">$<?= $item['price']; ?></p>
                    <button class="order-btn">Order Now</button>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

      <!-- Butoni Logout në fund të faqes (shfaqet vetëm nëse përdoruesi është i kyçur) -->
    <?php if (isset($_SESSION['user_id'])): ?>
        <div class="logout-container">
            <a href="php/logout.php" class="logout-button">LOGOUT</a>
        </div>
    <?php endif; ?>

    <style>
    /* CSS for logout button */
    .logout-container{
        text-align: center;
        margin: 40px ;
    }
    .logout-button{
        display: inline-block;
        background-color: #836758 ;
        color: black;
        padding: 12px 25px;
        font-size: 18px;
        font-family: "Merienda", cursive;
        text-decoration: none;
        border-radius: 8px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }
    .logout-button:hover{
        background-color: #fff8e1;
        transform: translateY(-3px);
    }
    
</style>


    <!--Footeri-->
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