<?php

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Faculty.php';

class FacultyController
{
    private $db;
    private $faculty;
    public $errors = [];

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
        $this->faculty = new Faculty($this->db);
    }

    private function validate($data)
    {
        $this->errors = [];

        if (empty(trim($data['first_name'] ?? ''))) {
            $this->errors['first_name'] = "First name is required.";
        }
        if (empty(trim($data['last_name'] ?? ''))) {
            $this->errors['last_name'] = "Last name is required.";
        }
        if (empty($data['age']) || !is_numeric($data['age']) || $data['age'] < 18 || $data['age'] > 80) {
            $this->errors['age'] = "Enter a valid age between 18 and 80.";
        }
        if (empty($data['gender']) || !in_array($data['gender'], ['Male', 'Female'])) {
            $this->errors['gender'] = "Please select a gender.";
        }
        if (empty(trim($data['address'] ?? ''))) {
            $this->errors['address'] = "Address is required.";
        }
        if (empty(trim($data['position'] ?? ''))) {
            $this->errors['position'] = "Position is required.";
        }
        if ($data['salary'] === '' || !is_numeric($data['salary']) || $data['salary'] < 0) {
            $this->errors['salary'] = "Enter a valid salary.";
        }

        return count($this->errors) === 0;
    }

    public function index()
    {
        $stmt = $this->faculty->readAll();
        $facultyList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require __DIR__ . '/../views/index.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->sanitize($_POST);

            if ($this->validate($data)) {
                $this->faculty->first_name  = $data['first_name'];
                $this->faculty->middle_name = $data['middle_name'];
                $this->faculty->last_name   = $data['last_name'];
                $this->faculty->age         = $data['age'];
                $this->faculty->gender      = $data['gender'];
                $this->faculty->address     = $data['address'];
                $this->faculty->position    = $data['position'];
                $this->faculty->salary      = $data['salary'];

                if ($this->faculty->create()) {
                    $_SESSION['flash_message'] = "Faculty record added successfully!";
                    header("Location: index.php?action=index");
                    exit;
                } else {
                    $this->errors['general'] = "Something went wrong while saving.";
                }
            }
            $formData = $data;
        }
        require __DIR__ . '/../views/create.php';
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: index.php?action=index");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->sanitize($_POST);

            if ($this->validate($data)) {
                $this->faculty->faculty_id  = $id;
                $this->faculty->first_name  = $data['first_name'];
                $this->faculty->middle_name = $data['middle_name'];
                $this->faculty->last_name   = $data['last_name'];
                $this->faculty->age         = $data['age'];
                $this->faculty->gender      = $data['gender'];
                $this->faculty->address     = $data['address'];
                $this->faculty->position    = $data['position'];
                $this->faculty->salary      = $data['salary'];

                if ($this->faculty->update()) {
                    $_SESSION['flash_message'] = "Faculty record updated successfully!";
                    header("Location: index.php?action=index");
                    exit;
                } else {
                    $this->errors['general'] = "Something went wrong while updating.";
                }
            }
            $record = $data;
            $record['faculty_id'] = $id;
        } else {
            $record = $this->faculty->readOne($id);
            if (!$record) {
                header("Location: index.php?action=index");
                exit;
            }
        }
        require __DIR__ . '/../views/edit.php';
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->faculty->delete($id);
            $_SESSION['flash_message'] = "Faculty record deleted successfully!";
        }
        header("Location: index.php?action=index");
        exit;
    }

    private function sanitize($data)
    {
        return array_map(function ($value) {
            return htmlspecialchars(trim($value ?? ''), ENT_QUOTES, 'UTF-8');
        }, $data);
    }
}
