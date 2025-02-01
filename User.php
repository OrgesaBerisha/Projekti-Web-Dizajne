<?php
class User
{
    private $conn;
    private $table_name = 'user';

    public function __construct($db)
    {
        $this->conn = $db;

        if (!$this->conn) {
            die('Database connection failed');
        }
    }

    public function register($name, $username, $email, $password)
    {
        // Vendos rolin në 'admin' për email-at që përfundojnë me @example.com, përndryshe 'user'
        $role = (strpos($email, '@example.com') !== false) ? 'admin' : 'user';
    
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        $query = "INSERT INTO {$this->table_name} (name, username, email, password, role)
                  VALUES (:name, :username, :email, :password, :role)";
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role', $role);
    
        if ($stmt->execute()) {
            return true;
        } else {
            echo "Error: " . $stmt->errorInfo()[2];
            return false;
        }
    }
    

    public function login($username, $password)
    {
        $query = "SELECT id, name, username, email, password, role FROM {$this->table_name} WHERE username = :username";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $row['password'])) {

                session_start();
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['role'] = $row['role'];
                return true;
            }
        }
        return false;
    }


 // Funksioni për editimin e përdoruesit
 public function updateUser($id, $name, $username, $email, $password, $role)

 {
     $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

     $query = "UPDATE {$this->table_name} SET name = :name, username = :username, email = :email, password = :password, role = :role WHERE id = :id";

     $stmt = $this->conn->prepare($query);

     $stmt->bindParam(':id', $id);
     $stmt->bindParam(':name', $name);
     $stmt->bindParam(':username', $username);
     $stmt->bindParam(':email', $email);
     $stmt->bindParam(':password', $hashedPassword);
     $stmt->bindParam(':role', $role);

     if ($stmt->execute()) {
         return true;
     } else {
         echo "Error: " . $stmt->errorInfo()[2];
         return false;
     }
 }

 // Funksioni për fshirjen e përdoruesit
 public function delete($id)
 {
     $query = "DELETE FROM {$this->table_name} WHERE id = :id";

     $stmt = $this->conn->prepare($query);
     $stmt->bindParam(':id', $id);

     if ($stmt->execute()) {
         return true;
     } else {
         echo "Error: " . $stmt->errorInfo()[2];
         return false;
     }
 }
}

?>