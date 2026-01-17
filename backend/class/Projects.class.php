<?php
class Projects
{
    private $conn;
    private $table_name = "projects";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get all projects for a specific user
    public function getProjectsByUser($user_id)
    {
        $query = "SELECT id, title, description, project_url, github_url, demo_url, 
                         image_preview, tags, start_date, end_date, status, featured, display_order
                  FROM " . $this->table_name . "
                  WHERE user_id = :user_id
                  ORDER BY featured DESC, display_order ASC, created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Add a new project
    public function createProject($data)
    {
        $query = "INSERT INTO " . $this->table_name . " 
                  (user_id, title, description, project_url, github_url, demo_url, 
                   image_preview, tags, start_date, end_date, status, featured, display_order)
                  VALUES (:user_id, :title, :description, :project_url, :github_url, :demo_url,
                          :image_preview, :tags, :start_date, :end_date, :status, :featured, :display_order)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $data["user_id"]);
        $stmt->bindParam(":title", $data["title"]);
        $stmt->bindParam(":description", $data["description"]);
        $stmt->bindParam(":project_url", $data["project_url"]);
        $stmt->bindParam(":github_url", $data["github_url"]);
        $stmt->bindParam(":demo_url", $data["demo_url"]);
        $stmt->bindParam(":image_preview", $data["image_preview"]);
        $stmt->bindParam(":tags", $data["tags"]);
        $stmt->bindParam(":start_date", $data["start_date"]);
        $stmt->bindParam(":end_date", $data["end_date"]);
        $stmt->bindParam(":status", $data["status"]);
        $stmt->bindParam(":featured", $data["featured"]);
        $stmt->bindParam(":display_order", $data["display_order"]);
        return $stmt->execute();
    }

    public function updateProject($data)
    {
        $query = "UPDATE " . $this->table_name . "
                  SET title=:title, description=:description, project_url=:project_url, 
                      github_url=:github_url, demo_url=:demo_url, 
                      tags=:tags, start_date=:start_date, end_date=:end_date, 
                      status=:status, featured=:featured, display_order=:display_order
                  WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $data["id"]);
        $stmt->bindParam(":title", $data["title"]);
        $stmt->bindParam(":description", $data["description"]);
        $stmt->bindParam(":project_url", $data["project_url"]);
        $stmt->bindParam(":github_url", $data["github_url"]);
        $stmt->bindParam(":demo_url", $data["demo_url"]);
        $stmt->bindParam(":tags", $data["tags"]);
        $stmt->bindParam(":start_date", $data["start_date"]);
        $stmt->bindParam(":end_date", $data["end_date"]);
        $stmt->bindParam(":status", $data["status"]);
        $stmt->bindParam(":featured", $data["featured"]);
        $stmt->bindParam(":display_order", $data["display_order"]);
        return $stmt->execute();
    }

    public function deleteProject($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
