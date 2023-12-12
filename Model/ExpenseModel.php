<?php
class ExpenseModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function createExpense($amount, $date, $categoryId) {
        // Implement SQL INSERT operation
        $sql = "INSERT INTO expenses (amount, date, category_id) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("dss", $amount, $date, $categoryId);
        $result = $stmt->execute();

        if ($result) {
            return $stmt->insert_id;
        } else {
            return false;
        }
    }

    public function getExpenseById($id) {
        // Implement SQL SELECT operation by ID
        $sql = "SELECT id, amount, date, category_id FROM expenses WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Fetch the expense data
            return $result->fetch_assoc();
        } else {
            // Expense not found
            return null;
        }
    }

    public function updateExpense($id, $amount, $date, $categoryId) {
        // Implement SQL UPDATE operation
        $sql = "UPDATE expenses SET amount = ?, date = ?, category_id = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("dssi", $amount, $date, $categoryId, $id);
        return $stmt->execute();
    }

    public function deleteExpense($id) {
        // Implement SQL DELETE operation
        $sql = "DELETE FROM expenses WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function getAllExpenses() {
        // Implement SQL SELECT operation for all expenses
        $sql = "SELECT id, amount, date, category_id FROM expenses";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            // Fetch all expenses
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            // No expenses found
            return [];
        }
    }
}
