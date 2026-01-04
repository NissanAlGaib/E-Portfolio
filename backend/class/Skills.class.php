<?php
class Skills {
    private $conn;
    private $table_name = "skills";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Get all skills for a specific user
    public function getSkillsByUser($user_id) {
        $query = "SELECT id, skill_name, skill_type, category, proficiency, years_experience, description, icon
                  FROM " . $this->table_name . "
                  WHERE user_id = :user_id
                  ORDER BY skill_type, category, skill_name ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Add a new skill
    public function createSkill($data) {
        $query = "INSERT INTO " . $this->table_name . " 
                  (user_id, skill_name, skill_type, category, proficiency, years_experience, description, icon)
                  VALUES (:user_id, :skill_name, :skill_type, :category, :proficiency, :years_experience, :description, :icon)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $data["user_id"]);
        $stmt->bindParam(":skill_name", $data["skill_name"]);
        $stmt->bindParam(":skill_type", $data["skill_type"]);
        $stmt->bindParam(":category", $data["category"]);
        $stmt->bindParam(":proficiency", $data["proficiency"]);
        $stmt->bindParam(":years_experience", $data["years_experience"]);
        $stmt->bindParam(":description", $data["description"]);
        $stmt->bindParam(":icon", $data["icon"]);
        return $stmt->execute();
    }

    public function updateSkill($data) {
        $query = "UPDATE " . $this->table_name . "
                  SET skill_name=:skill_name, skill_type=:skill_type, category=:category, 
                      proficiency=:proficiency, years_experience=:years_experience, 
                      description=:description, icon=:icon
                  WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    public function deleteSkill($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
