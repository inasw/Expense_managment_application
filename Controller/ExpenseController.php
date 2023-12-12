<?php
class ExpenseController {
    private $expenseModel;
    private $categoryModel;

    public function __construct($expenseModel, $categoryModel) {
        $this->expenseModel = $expenseModel;
        $this->categoryModel = $categoryModel;
    }

    public function addExpenseAction() {
        // Implement rendering and handling of the add expense form
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $amount = $_POST['amount'];
            $date = $_POST['date'];
            $category = $_POST['category'];
    
            // Validate input (add your validation logic here)
            if (empty($amount) || empty($date) || empty($category)) {
                // Display validation error (you can customize error handling)
                echo "Please fill in all fields.";
                return;
            }
    
            // Create expense
            $expenseId = $this->expenseModel->createExpense($amount, $date, $category);
    
            if ($expenseId) {
                // Expense created successfully, redirect or display success message
                header('Location: expense_list.php');
                exit();
            } else {
                // Error creating expense, display error message
                echo "Error creating expense.";
            }
        }
    
        // Fetch categories for the dropdown in the form
        $categories = $this->expenseModel->getAllCategories();
    
        // Render the add expense form (customize the HTML form code based on your needs)
        include 'View/add_expense.php';
    }

    public function editExpenseAction($id) {
        // Implement rendering and handling of the edit expense form
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $amount = $_POST['amount'];
            $date = $_POST['date'];
            $category = $_POST['category'];

            // Validate input (add your validation logic here)

            // Update expense
            $result = $this->expenseModel->updateExpense($id, $amount, $date, $category);

            if ($result) {
                // Expense updated successfully, redirect or display success message
                header('Location: expense_list.php');
                exit();
            } else {
                // Error updating expense, display error message
                echo "Error updating expense.";
            }
        }

        // Fetch expense details for editing
        $expense = $this->expenseModel->getExpenseById($id);

        if (!$expense) {
            // Expense not found, display error message
            echo "Expense not found.";
            exit();
        }

        // Render the edit expense form (add your HTML form code here)
        include 'View/edit_expense.php';
    }

    public function deleteExpenseAction($id) {
        // Implement handling of expense deletion
        $result = $this->expenseModel->deleteExpense($id);

        if ($result) {
            // Expense deleted successfully, redirect or display success message
            header('Location: expense_list.php');
            exit();
        } else {
            // Error deleting expense, display error message
            echo "Error deleting expense.";
        }
    }

    public function viewExpensesAction() {
        // Implement retrieving expenses and rendering the expense list view
         // Fetch all expenses
    $expenses = $this->expenseModel->getAllExpenses();

    // Render the expense list view
    include 'View/expense_list.php';
    }

    public function generateExpenseReportAction() {
        // Implement generating and displaying an expense report
        include 'View/expense_report.php';
    }
}
