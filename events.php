<?php
require_once 'php/Database.php';

class Event {
    private $db;

    public function __construct(){
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getEvents(){
        $query = "SELECT * FROM events ORDER BY date ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

$event = new Event();
$events = $event->getEvents();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EVENTS</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/events.css">
</head>

<body>
    <header>
        <nav class="navbar">
            <ul class="nav-links">
                <li><a href="index.php" >HOME</a></li>
                <li><a href="menu.php">MENU</a></li>
                <li><a href="message.php">SEND A MESSAGE</a></li>

            </ul>
            <div class="logo">
                <img src="img/Logo.png" alt="Daisy Logo">
                <h1>DAISY</h1>
            </div>
            <ul class="nav-links">
                <li><a href="about.php">ABOUT</a></li>
                <li><a href="events.php" id="active">EVENTS</a></li>
                <li><a href="contactus.php">CONTACT US</a></li>
            </ul>
        </nav>
    </header>

    <main>
    <section class="events-section">
            <h1>Upcoming Events at Daisy</h1>
            <?php foreach ($events as $eventItem): ?>
                <div class="event-card">
                    <img src="img/<?= $eventItem['image']; ?>" alt="<?= $eventItem['title']; ?>">
                    <div class="event-info">
                        <h2><?= $eventItem['title']; ?></h2>
                        <p><strong>Date:</strong> <?= date('F d, Y', strtotime($eventItem['date'])); ?></p>
                        <p><?= $eventItem['description']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>
    </main>

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