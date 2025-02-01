<?php
session_start();
include_once 'contactRepository.php';
include_once 'contactModel.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['name'], $_POST['email'], $_POST['message'])) {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $message = trim($_POST['message']);


        if (empty($name) || empty($email) || empty($message)) {
            echo "<script>alert('All fields are required!'); window.history.back();</script>";
            exit();
        }

      
        $contact = new Contact($name, $email, $message);

   
        $contactRepository = new ContactRepository();
        $result = $contactRepository->insertMessage($contact);

        if ($result) {
           
            header("Location: ../index.php");
            exit();
        } else {
            echo "<script>alert('Error saving message! Try again.'); window.history.back();</script>";
            exit();
        }
    } else {
        echo "<script>alert('Invalid form submission!'); window.history.back();</script>";
        exit();
    }
} else {
    echo "<script>alert('Invalid request!'); window.history.back();</script>";
    exit();
}
?>