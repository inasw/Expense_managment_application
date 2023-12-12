<?php
 
$host = "localhost";
$username = "root";
$password = "";
$dbname = "expense_management";

// Create connection
$conn = new mysqli($host, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully\n";
} else {
    echo "Error creating database: " . $conn->error;
}

// Select the created database
$conn->select_db($dbname);

// Create categories table
$sql = "CREATE TABLE IF NOT EXISTS categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
   
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'categories' created successfully\n";
} else {
    echo "Error creating table 'categories': " . $conn->error;
}

// Create expenses table
$sql = "CREATE TABLE IF NOT EXISTS expenses (
    id INT PRIMARY KEY AUTO_INCREMENT,
    amount DECIMAL(10, 2),
    date DATE,
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES categories(id)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'expenses' created successfully\n";
} else {
    echo "Error creating table 'expenses': " . $conn->error;
}



// Close the connection
$conn->close();

?>
