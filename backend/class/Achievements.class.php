<?php
class Achievements {
    private $conn;
    private $table_name = "achievements";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Get all achievements for a specific user
    public function getAchievementsByUser($user_id) {
        $query = "SELECT id, title, description, category, issuer, date_achieved, image, display_order
                  FROM " . $this->table_name . "
                  WHERE user_id = :user_id
                  ORDER BY display_order ASC, date_achieved DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Add a new achievement
    public function createAchievement($data) {
        $query = "INSERT INTO " . $this->table_name . " 
                  (user_id, title, description, category, issuer, date_achieved, image, display_order)
                  VALUES (:user_id, :title, :description, :category, :issuer, :date_achieved, :image, :display_order)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $data["user_id"]);
        $stmt->bindParam(":title", $data["title"]);
        $stmt->bindParam(":description", $data["description"]);
        $stmt->bindParam(":category", $data["category"]);
        $stmt->bindParam(":issuer", $data["issuer"]);
        $stmt->bindParam(":date_achieved", $data["date_achieved"]);
        $stmt->bindParam(":image", $data["image"]);
        $stmt->bindParam(":display_order", $data["display_order"]);
        return $stmt->execute();
    }

    public function updateAchievement($data) {
        $query = "UPDATE " . $this->table_name . "
                  SET title=:title, description=:description, category=:category, 
                      issuer=:issuer, date_achieved=:date_achieved, image=:image, display_order=:display_order
                  WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    public function deleteAchievement($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
