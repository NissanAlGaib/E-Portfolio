<?php
class Contacts {
    private $conn;
    private $table_name = "contacts";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Get all contact messages
    public function getAllContacts() {
        $query = "SELECT id, name, email, subject, message, status, ip_address, created_at
                  FROM " . $this->table_name . "
                  ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get contacts by status
    public function getContactsByStatus($status) {
        $query = "SELECT id, name, email, subject, message, status, ip_address, created_at
                  FROM " . $this->table_name . "
                  WHERE status = :status
                  ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":status", $status);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Add a new contact message
    public function createContact($data) {
        $query = "INSERT INTO " . $this->table_name . " 
                  (name, email, subject, message, status, ip_address)
                  VALUES (:name, :email, :subject, :message, :status, :ip_address)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $data["name"]);
        $stmt->bindParam(":email", $data["email"]);
        $stmt->bindParam(":subject", $data["subject"]);
        $stmt->bindParam(":message", $data["message"]);
        $stmt->bindParam(":status", $data["status"]);
        $stmt->bindParam(":ip_address", $data["ip_address"]);
        return $stmt->execute();
    }

    // Update contact status
    public function updateContactStatus($id, $status) {
        $query = "UPDATE " . $this->table_name . "
                  SET status=:status
                  WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    public function deleteContact($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
