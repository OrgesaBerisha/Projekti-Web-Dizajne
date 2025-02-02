<?php

include_once 'Database.php';
include_once 'User.php';

$id = $_GET['id'];
$db = new Database();
$connection = $db->getConnection();
$user = new User($connection);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($user->delete($id)) {
        echo "User deleted successfully!";
      
        header("Location: ../admin_dashboard.php");
        exit;
    } else {
        echo "Deletion failed!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Deletion</title>
</head>
<body>

<h2>Are you sure you want to delete this user?</h2>

<form method="POST">
    <button type="submit" name="delete" class="button delete">Save & Go to Dashboard</button>
</form>

</body>
</html>

