<?php
include_once 'Database.php';
include_once 'contactModel.php';
class ContactRepository {
    private $connection;

    public function __construct() {
        $database = new Database();
        $this->connection = $database->getConnection();
    }


    public function insertMessage($contact) {
        try {
            $sql = "INSERT INTO contacts (name, email, message, created_at) VALUES (?, ?, ?, NOW())";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([
                $contact->getName(),
                $contact->getEmail(),
                $contact->getMessage()
            ]);
            return true;
        } catch (PDOException $e) {
            return false; 
        }
    }

    
    public function getAllMessages() {
        $sql = "SELECT * FROM contacts ORDER BY created_at DESC";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

public function deleteMessage($id) {
    $conn = $this->connection;

    $sql = "DELETE FROM contacts WHERE id = ?";
    $statement = $conn->prepare($sql);
    $statement->execute([$id]);

    echo "<script>alert('Delete was successful');</script>";
}
}
?>