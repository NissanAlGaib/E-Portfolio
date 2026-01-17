<?php
class Education
{
    private $conn;
    private $table_name = "education";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get all education records for a specific user
    public function getEducationByUser($user_id)
    {
        $query = "SELECT id, institution_name, degree, field_of_study, location, 
                         start_date, end_date, gpa, description, logo
                  FROM " . $this->table_name . "
                  WHERE user_id = :user_id
                  ORDER BY start_date DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Add a new education record
    public function createEducation($data)
    {
        $query = "INSERT INTO " . $this->table_name . " 
                  (user_id, institution_name, degree, field_of_study, location, 
                   start_date, end_date, gpa, description, logo)
                  VALUES (:user_id, :institution_name, :degree, :field_of_study, :location,
                          :start_date, :end_date, :gpa, :description, :logo)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $data["user_id"]);
        $stmt->bindParam(":institution_name", $data["institution_name"]);
        $stmt->bindParam(":degree", $data["degree"]);
        $stmt->bindParam(":field_of_study", $data["field_of_study"]);
        $stmt->bindParam(":location", $data["location"]);
        $stmt->bindParam(":start_date", $data["start_date"]);
        $stmt->bindParam(":end_date", $data["end_date"]);
        $stmt->bindParam(":gpa", $data["gpa"]);
        $stmt->bindParam(":description", $data["description"]);
        $stmt->bindParam(":logo", $data["logo"]);
        return $stmt->execute();
    }

    public function updateEducation($data)
    {
        $query = "UPDATE " . $this->table_name . "
                  SET institution_name=:institution_name, degree=:degree, field_of_study=:field_of_study,
                      location=:location, start_date=:start_date, end_date=:end_date, 
                      gpa=:gpa, description=:description
                  WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $data["id"]);
        $stmt->bindParam(":institution_name", $data["institution_name"]);
        $stmt->bindParam(":degree", $data["degree"]);
        $stmt->bindParam(":field_of_study", $data["field_of_study"]);
        $stmt->bindParam(":location", $data["location"]);
        $stmt->bindParam(":start_date", $data["start_date"]);
        $stmt->bindParam(":end_date", $data["end_date"]);
        $stmt->bindParam(":gpa", $data["gpa"]);
        $stmt->bindParam(":description", $data["description"]);
        return $stmt->execute();
    }

    public function deleteEducation($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
