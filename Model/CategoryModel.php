<?php
class CategoryModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function createCategory($name) {
        // Implement SQL INSERT operation
        
    $sql = "INSERT INTO categories (name) VALUES (?)";

    // Use a prepared statement to prevent SQL injection
    $stmt = $this->db->prepare($sql);

    // Bind the parameters
    $stmt->bind_param("s", $name);

    // Execute the statement
    $result = $stmt->execute();

    // Check if the insertion was successful
    if ($result) {
        // Return the ID of the inserted category
        return $stmt->insert_id;
    } else {
        // Return false or handle the error as needed
        return false;
    }
    }

    public function getCategoryById($id) {
        // Implement SQL SELECT operation by ID
        $sql = "SELECT id, name FROM categories WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Fetch the category data
            return $result->fetch_assoc();
        } else {
            // Category not found
            return null;
        }
    }

    public function getAllCategories() {
        // Implement SQL SELECT operation for all categories
        $sql = "SELECT id, name FROM categories";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            // Fetch all categories
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            // No categories found
            return [];
        }
    }
    }

