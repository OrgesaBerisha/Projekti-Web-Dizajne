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

// Kontrollo nëse është dërguar një ID e përdoruesit për editim
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Merr të dhënat e përdoruesit nga databaza
    $query = "SELECT * FROM user WHERE id = :id";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':id', $user_id);
    $stmt->execute();
    $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Merr të dhënat e reja të përdoruesit nga formulari
        $name = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        // Përdor funksionin për të përditësuar përdoruesin
        if ($user->updateUser($user_id, $name, $username, $email, $password, $role)) {
            header("Location: ../admin_dashboard.php");
            exit;
        } else {
            echo "Ka ndodhur një gabim gjatë përditësimit!";
        }
    }
} else {
    echo "Përdoruesi nuk ekziston!";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edito Përdoruesin</title>
</head>
<body>

<div>
    <h2>Edit User: <?php echo $user_data['name']; ?></h2>
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo $user_data['name']; ?>" required><br>

        <label>Username:</label>
        <input type="text" name="username" value="<?php echo $user_data['username']; ?>" required><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $user_data['email']; ?>" required><br>

        <label>Password:</label>
        <input type="password" name="password" required><br>

        <label>Role:</label>
        <select name="role">
            <option value="admin" <?php echo ($user_data['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
            <option value="user" <?php echo ($user_data['role'] == 'user') ? 'selected' : ''; ?>>User</option>
        </select><br>

        <input type="submit" value="Save">
    </form>
</div>

</body>
</html>