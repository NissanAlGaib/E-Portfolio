<?php
class User
{
    private $conn;
    private $table_name = "profile";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllUsers()
    {
        $query = "SELECT * FROM " . $this->table_name . " LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProfile($id, $first_name, $last_name, $middle_initial, $job_title, $email, $phone, $location, $bio, $linkedin_url, $github_url, $portfolio_url, $profile_image = null)
    {
        if ($profile_image) {
            $query = "UPDATE " . $this->table_name . " SET first_name = :first_name, last_name = :last_name, middle_initial = :middle_initial, job_title = :job_title, email = :email, phone = :phone, location = :location, bio = :bio, linkedin_url = :linkedin_url, github_url = :github_url, portfolio_url = :portfolio_url, profile_image = :profile_image WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':first_name', $first_name);
            $stmt->bindParam(':last_name', $last_name);
            $stmt->bindParam(':middle_initial', $middle_initial);
            $stmt->bindParam(':job_title', $job_title);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':location', $location);
            $stmt->bindParam(':bio', $bio);
            $stmt->bindParam(':linkedin_url', $linkedin_url);
            $stmt->bindParam(':github_url', $github_url);
            $stmt->bindParam(':portfolio_url', $portfolio_url);
            $stmt->bindParam(':profile_image', $profile_image);
            $stmt->bindParam(':id', $id);
        } else {
            $query = "UPDATE " . $this->table_name . " SET first_name = :first_name, last_name = :last_name, middle_initial = :middle_initial, job_title = :job_title, email = :email, phone = :phone, location = :location, bio = :bio, linkedin_url = :linkedin_url, github_url = :github_url, portfolio_url = :portfolio_url WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':first_name', $first_name);
            $stmt->bindParam(':last_name', $last_name);
            $stmt->bindParam(':middle_initial', $middle_initial);
            $stmt->bindParam(':job_title', $job_title);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':location', $location);
            $stmt->bindParam(':bio', $bio);
            $stmt->bindParam(':linkedin_url', $linkedin_url);
            $stmt->bindParam(':github_url', $github_url);
            $stmt->bindParam(':portfolio_url', $portfolio_url);
            $stmt->bindParam(':id', $id);
        }

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
