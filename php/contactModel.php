<?php
class Contact {
    private $name;
    private $email;
    private $message;

    public function __construct($name, $email, $message) {
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
    }

    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getMessage() {
        return $this->message;
    }
}
?>