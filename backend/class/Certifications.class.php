<?php
class Certifications {
    private $conn;
    private $table_name = "certifications";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Get all certifications for a specific user
    public function getCertificationsByUser($user_id) {
        $query = "SELECT id, certification_name, issuing_organization, issue_date, 
                         expiry_date, credential_id, credential_url, description, logo
                  FROM " . $this->table_name . "
                  WHERE user_id = :user_id
                  ORDER BY issue_date DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Add a new certification
    public function createCertification($data) {
        $query = "INSERT INTO " . $this->table_name . " 
                  (user_id, certification_name, issuing_organization, issue_date, 
                   expiry_date, credential_id, credential_url, description, logo)
                  VALUES (:user_id, :certification_name, :issuing_organization, :issue_date,
                          :expiry_date, :credential_id, :credential_url, :description, :logo)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $data["user_id"]);
        $stmt->bindParam(":certification_name", $data["certification_name"]);
        $stmt->bindParam(":issuing_organization", $data["issuing_organization"]);
        $stmt->bindParam(":issue_date", $data["issue_date"]);
        $stmt->bindParam(":expiry_date", $data["expiry_date"]);
        $stmt->bindParam(":credential_id", $data["credential_id"]);
        $stmt->bindParam(":credential_url", $data["credential_url"]);
        $stmt->bindParam(":description", $data["description"]);
        $stmt->bindParam(":logo", $data["logo"]);
        return $stmt->execute();
    }

    public function updateCertification($data) {
        $query = "UPDATE " . $this->table_name . "
                  SET certification_name=:certification_name, issuing_organization=:issuing_organization,
                      issue_date=:issue_date, expiry_date=:expiry_date, credential_id=:credential_id,
                      credential_url=:credential_url, description=:description, logo=:logo
                  WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    public function deleteCertification($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
