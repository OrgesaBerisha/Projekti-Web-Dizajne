<?php

require_once 'Database.php';

 
class AdminMenu {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection(); // Get PDO connection
    }

    public function getAllMenuItems() {
        $query = "SELECT * FROM menu_items";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getChangeLogs() {
        $query = "SELECT * FROM change_logs ORDER BY created_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addMenuItem($name, $description, $price, $category, $image) {
        // Validoni imazhin
        if ($_FILES['image']['error'] == 0) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $maxSize = 2 * 1024 * 1024; // 2MB
            
            if (!in_array($_FILES['image']['type'], $allowedTypes)) {
                echo "Lloji i imazhit është i pavlefshëm.";
                return false;
            }
            
            if ($_FILES['image']['size'] > $maxSize) {
                echo "Madhësia e imazhit kalon kufirin.";
                return false;
            }
    
            // Gjeneroni një emër unik për imazhin
            $imageName = time() . '_' . $_FILES['image']['name'];
            $imageTmpName = $_FILES['image']['tmp_name'];
            $uploadDir = 'img/';
            $imagePath = $uploadDir . basename($imageName);
    
            if (move_uploaded_file($imageTmpName, $imagePath)) {
                $query1 = "INSERT INTO menu_items (name, description, price, category, image) 
                           VALUES (:name, :description, :price, :category, :image)";
                $stmt1 = $this->db->prepare($query1);
                $stmt1->bindParam(':name', $name);
                $stmt1->bindParam(':description', $description);
                $stmt1->bindParam(':price', $price);
                $stmt1->bindParam(':category', $category);
                $stmt1->bindParam(':image', $imagePath);
                $stmt1->execute();
        
                $menuid = $this->db->lastInsertId();
        
                $query2 = "INSERT INTO menu_admin (name, description, price, category, image, menuid) 
                           VALUES (:name, :description, :price, :category, :image, :menuid)";
                $stmt2 = $this->db->prepare($query2);
                $stmt2->bindParam(':name', $name);
                $stmt2->bindParam(':description', $description);
                $stmt2->bindParam(':price', $price);
                $stmt2->bindParam(':category', $category);
                $stmt2->bindParam(':image', $imagePath);
                $stmt2->bindParam(':menuid', $menuid);
                $stmt2->execute();


                  
        // Log the change
        $this->logChange('INSERT', 'menu_items', $name, $description, $price, $category, $imagePath);
        return true;
            } else {
                echo "Dështoi ngarkimi i imazhit.";
                return false;
            }
        } else {
            echo "Gabim gjatë ngarkimit të imazhit.";
            return false;
        }
    }
    
    public function deleteMenuItem($id) {
        // Get the name of the item before deleting
        $query = "SELECT name FROM menu_items WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $item = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Delete from menu_admin first
        $query1 = "DELETE FROM menu_admin WHERE menuid = :id";
        $stmt1 = $this->db->prepare($query1);
        $stmt1->bindParam(':id', $id);
        $stmt1->execute();
        
        // Then delete from menu_items
        $query2 = "DELETE FROM menu_items WHERE id = :id";
        $stmt2 = $this->db->prepare($query2);
        $stmt2->bindParam(':id', $id);
        $stmt2->execute();
        
        // Log the change
        $this->logChange('DELETE', 'menu_items', $item['name'], '', '', '', '');
        
        return true;
    }

    public function logChange($action, $tableName, $name, $description, $price, $category, $image) {
        $userId = $_SESSION['user_id']; // Set dynamically based on logged-in user (make sure to set user_id in session)
        $details = json_encode(compact('name', 'description', 'price', 'category', 'image'));

        $query = "INSERT INTO change_logs (action, table_name, user_id, details) 
                  VALUES (:action, :table_name, :user_id, :details)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':action', $action);
        $stmt->bindParam(':table_name', $tableName);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':details', $details);
        $stmt->execute();
    }
    
}

$adminMenu = new AdminMenu();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $adminMenu->addMenuItem($_POST['name'], $_POST['description'], $_POST['price'], $_POST['category'], $_FILES['image']);
    } elseif (isset($_POST['delete'])) {
        $adminMenu->deleteMenuItem($_POST['id']);
    }
}

$menuItems = $adminMenu->getAllMenuItems();
?>
