<?php
session_start();
include_once 'Database.php';
include_once 'User.php';
include_once 'contactRepository.php';

// Kontrollo nëse përdoruesi është i kyçur dhe është admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$db = new Database();
$connection = $db->getConnection();
$user = new User($connection);
$contactRepo = new ContactRepository();

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 0; }
        .container { max-width: 900px; margin: auto; padding: 20px; background: white; border-radius: 8px; margin-top: 50px; }
        .header { background-color: #d0c9b5; color: white; padding: 15px; text-align: center; font-size: 20px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { padding: 10px; border: 1px solid #ddd; text-align: center; }
        .button { padding: 5px 10px; box-shadow: 0px 0px 10px gray;color: black; border-radius: 5px; text-decoration: none; }
        .delete { background-color: red; color: white; }
    </style>
</head>
<body>

<div class="header">
    <h2>Admin Dashboard</h2>
    <a href="logout.php" class="button">Log Out</a>
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

</body>
</html>

