<?php
include_once("../db.php");
include_once("../employee.php"); 


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id']; // Retrieve the 'id' from the URL

    $db = new Database();
    $employee = new Employee($db);

 
    if ($employee->delete($id)) {
        echo "Record deleted successfully.";
    } else {
        echo "Failed to delete the record.";
    }
    
    header("Location: employee_view.php");
}
?>
