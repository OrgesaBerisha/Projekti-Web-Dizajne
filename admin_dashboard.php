<?php
session_start();
include_once 'Database.php';
include_once 'User.php';

// Kontrollo nëse përdoruesi është i kyçur dhe është admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$db = new Database();
$connection = $db->getConnection();
$user = new User($connection);

// Merr të gjithë përdoruesit nga databaza
$query = "SELECT * FROM user";
$stmt = $connection->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Kontrollo nëse është bërë ndonjë veprim (fshirje/aktualizim)
if (isset($_GET['delete_id'])) {
    $user_id = $_GET['delete_id'];
    $user->delete($user_id);
    header("Location: admin_dashboard.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        body { font-family: Arial, sans-serif; background:color:  #f4f4f4; margin: 0; padding: 0; }
        .container { max-width: 900px; margin: auto; padding: 20px; background: white;  border-radius: 8px; margin-top: 50px; }
        .header { background-color: #d0c9b5; color: white; padding: 15px; text-align: center; font-size: 20px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { padding: 10px; border: 1px solid #ddd; text-align: center; }
        .button { padding: 5px 10px; box-shadow: 0px 0px 10px gray;color: black; border-radius: 5px; text-decoration: none; }
        
    </style>
</head>
<body>

<div class="header">
    <h2>Manage Users</h2>
    
   
    <a href="logout.php" class="button"  color: white;>Log Out</a>
</div>

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
                <th>Edit/Delete</th>
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

</body>
</html>
