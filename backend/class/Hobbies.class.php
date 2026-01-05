<?php
class Hobbies
{
    private $conn;
    private $table_name = "hobbies";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get all hobbies for a specific user
    public function getHobbiesByUser($user_id)
    {
        $query = "SELECT id, hobby_name, description, icon, category, proficiency
                  FROM " . $this->table_name . "
                  WHERE user_id = :user_id
                  ORDER BY category, hobby_name ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Add a new hobby
    public function createHobby($data)
    {
        $query = "INSERT INTO " . $this->table_name . " 
                  (user_id, hobby_name, description, icon, category, proficiency)
                  VALUES (:user_id, :hobby_name, :description, :icon, :category, :proficiency)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $data["user_id"]);
        $stmt->bindParam(":hobby_name", $data["hobby_name"]);
        $stmt->bindParam(":description", $data["description"]);
        $stmt->bindParam(":icon", $data["icon"]);
        $stmt->bindParam(":category", $data["category"]);
        $stmt->bindParam(":proficiency", $data["proficiency"]);
        return $stmt->execute();
    }

    public function updateHobby($data)
    {
        $query = "UPDATE " . $this->table_name . "
                  SET hobby_name=:hobby_name, description=:description, category=:category
                  WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $data["id"]);
        $stmt->bindParam(":hobby_name", $data["hobby_name"]);
        $stmt->bindParam(":description", $data["description"]);
        $stmt->bindParam(":category", $data["category"]);
        return $stmt->execute();
    }

    public function deleteHobby($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
