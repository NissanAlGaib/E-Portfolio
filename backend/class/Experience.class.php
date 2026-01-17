<?php
class Experience {
    private $conn;
    private $table_name = "experience";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Get all experience records for a specific user
    public function getExperienceByUser($user_id) {
        $query = "SELECT id, company_name, job_title, location, employment_type, 
                         start_date, end_date, description, responsibilities, achievements, company_logo
                  FROM " . $this->table_name . "
                  WHERE user_id = :user_id
                  ORDER BY start_date DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Add a new experience record
    public function createExperience($data) {
        $query = "INSERT INTO " . $this->table_name . " 
                  (user_id, company_name, job_title, location, employment_type, 
                   start_date, end_date, description, responsibilities, achievements, company_logo)
                  VALUES (:user_id, :company_name, :job_title, :location, :employment_type,
                          :start_date, :end_date, :description, :responsibilities, :achievements, :company_logo)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $data["user_id"]);
        $stmt->bindParam(":company_name", $data["company_name"]);
        $stmt->bindParam(":job_title", $data["job_title"]);
        $stmt->bindParam(":location", $data["location"]);
        $stmt->bindParam(":employment_type", $data["employment_type"]);
        $stmt->bindParam(":start_date", $data["start_date"]);
        $stmt->bindParam(":end_date", $data["end_date"]);
        $stmt->bindParam(":description", $data["description"]);
        $stmt->bindParam(":responsibilities", $data["responsibilities"]);
        $stmt->bindParam(":achievements", $data["achievements"]);
        $stmt->bindParam(":company_logo", $data["company_logo"]);
        return $stmt->execute();
    }

    public function updateExperience($data) {
        $query = "UPDATE " . $this->table_name . "
                  SET company_name=:company_name, job_title=:job_title, location=:location,
                      employment_type=:employment_type, start_date=:start_date, end_date=:end_date,
                      description=:description, responsibilities=:responsibilities, 
                      achievements=:achievements, company_logo=:company_logo
                  WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    public function deleteExperience($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
