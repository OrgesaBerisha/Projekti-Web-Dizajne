<?php
session_start();
include_once 'php/Database.php';
include_once 'php/User.php';
include_once 'php/contactRepository.php';
include_once 'php/AdminMenu.php';


// Kontrollo nëse përdoruesi është i kyçur dhe është admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$db = new Database();
$connection = $db->getConnection();
$user = new User($connection);
$contactRepo = new ContactRepository();
$adminMenu = new AdminMenu();

$menuItems = $adminMenu->getAllMenuItems();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $adminMenu->addMenuItem($_POST['name'], $_POST['description'], $_POST['price'], $_POST['category'], $_FILES['image']);
    } elseif (isset($_POST['delete'])) {
        $adminMenu->deleteMenuItem($_POST['id']);
    }
    header("Location: admin_dashboard.php");
    exit;
}
if (isset($_GET['delete_menu'])) {
    $menuid = $_GET['delete_menu'];
    $adminMenu->deleteMenuItem($menuid);
    header("Location: admin_dashboard.php");
    exit;
}

// Merr të gjithë përdoruesit nga databaza
$query = "SELECT * FROM user";
$stmt = $connection->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Merr të gjitha mesazhet nga databaza
$messages = $contactRepo->getAllMessages();

// Fshirja e mesazheve
if (isset($_GET['delete_message'])) {
    $message_id = $_GET['delete_message'];
    $contactRepo->deleteMessage($message_id);
    header("Location: admin_dashboard.php");
    exit;
}

// Fshirja e produkteve
if (isset($_GET['delete_menu'])) {
    $menuid = $_GET['delete_menu'];
    $adminMenu->deleteMenuItem($menuid);
    header("Location: admin_dashboard.php");
    exit;
}

$logs = $adminMenu->getChangeLogs();




    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/admin_dashboard.css">
</head>
<body>

<div class="header">
    <h2>Admin Dashboard</h2>
    <a href="php/logout.php" class="button">Log Out</a>
</div>

<div class="container">
    <h3>User List</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['name']; ?></td>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['role']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $user['id']; ?>" class="button">Edit</a>
                    <a href="?delete_id=<?php echo $user['id']; ?>" class="button delete" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="container">
    <h3>Messages</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($messages as $message): ?>
            <tr>
                <td><?php echo $message['name']; ?></td>
                <td><?php echo $message['email']; ?></td>
                <td><?php echo $message['message']; ?></td>
                <td><?php echo $message['created_at']; ?></td>
                <td>
                    <a href="?delete_message=<?php echo $message['id']; ?>" class="button delete" onclick="return confirm('Are you sure you want to delete this message?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="container">
    <h3>Menu Management</h3>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Name" required>
        <input type="text" name="description" placeholder="Description" required>
        <input type="number" name="price" placeholder="Price" step="0.01" required>
        <input type="text" name="category" placeholder="Category" required>
        <input type="file" name="image" required>
        <button type="submit" name="add">Add Item</button>
    </form>
    <table class="table">
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Category</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        <?php foreach ($menuItems as $item): ?>
        <tr>
            <td><?= $item['name'] ?></td>
            <td><?= $item['description'] ?></td>
            <td>$<?= $item['price'] ?></td>
            <td><?= $item['category'] ?></td>
            <td><img src="<?= $item['image'] ?>" width="50"></td>
            <td>
                <form method="POST">
                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                    <!-- <button type="submit" name="delete" class="button delete">Delete</button> -->
                    <button type="button" class="button delete" onclick="deleteMenuItem(<?php echo $item['id']; ?>)">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<div class="container">
    <h3>Change Logs</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Action</th>
                <th>Table</th>
                <th>Details</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($logs as $log): ?>
            <tr>
                <td><?php echo $log['action']; ?></td>
                <td><?php echo $log['table_name']; ?></td>
                <td>
                    <?php
                    $details = json_decode($log['details'], true);
                    echo "Name: " . $details['name'] . "<br>";
                    echo "Description: " . $details['description'] . "<br>";
                    echo "Price: $" . $details['price'] . "<br>";
                    echo "Category: " . $details['category'] . "<br>";
                    echo "Image: <img src='" . $details['image'] . "' width='50'>";
                    ?>
                </td>
                <td><?php echo $log['created_at']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>





</body>
<script>
 function deleteMenuItem(id) {
    if (confirm("Are you sure you want to delete this item?")) {
        window.location.href = "admin_dashboard.php?delete_menu=" + id;
    }
}
</script>
</html>

