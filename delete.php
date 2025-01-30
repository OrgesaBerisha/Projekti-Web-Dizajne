<?php
include_once 'Database.php';
include_once 'User.php';

$id = $_GET['id'];
$db = new Database();
$connection = $db->getConnection();
$user = new User($connection);

if ($user->delete($id)) {
    echo "User deleted successfully!";
} else {
    echo "Deletion failed!";
}
?>
