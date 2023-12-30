<?php
include_once("../db.php"); // Include the Database class file
include_once("../goalprogress.php"); 


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id']; // Retrieve the 'id' from the URL

    // Instantiate the Database and Student classes
    $db = new Database();
    $goalprogress = new GoalProgress($db);

    // Call the delete method to delete the student record
    if ($goalprogress->delete($id)) {
        echo "Record deleted successfully.";
    } else {
        echo "Failed to delete the record.";
    }
    header("Location: goalprogress_view.php");
    
}
?>