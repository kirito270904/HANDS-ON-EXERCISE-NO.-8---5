<?php

class Faculty
{
    private $conn;
    private $table = "faculty";

    public $faculty_id;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $age;
    public $gender;
    public $address;
    public $position;
    public $salary;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table . "
                  (first_name, middle_name, last_name, age, gender, address, position, salary)
                  VALUES (:first_name, :middle_name, :last_name, :age, :gender, :address, :position, :salary)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":middle_name", $this->middle_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":age", $this->age);
        $stmt->bindParam(":gender", $this->gender);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":position", $this->position);
        $stmt->bindParam(":salary", $this->salary);

        return $stmt->execute();
    }

    public function readAll()
    {
        $query = "SELECT * FROM " . $this->table . " ORDER BY faculty_id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE faculty_id = :faculty_id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":faculty_id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update()
    {
        $query = "UPDATE " . $this->table . "
                  SET first_name = :first_name,
                      middle_name = :middle_name,
                      last_name = :last_name,
                      age = :age,
                      gender = :gender,
                      address = :address,
                      position = :position,
                      salary = :salary
                  WHERE faculty_id = :faculty_id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":middle_name", $this->middle_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":age", $this->age);
        $stmt->bindParam(":gender", $this->gender);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":position", $this->position);
        $stmt->bindParam(":salary", $this->salary);
        $stmt->bindParam(":faculty_id", $this->faculty_id);

        return $stmt->execute();
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE faculty_id = :faculty_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":faculty_id", $id);
        return $stmt->execute();
    }
}
