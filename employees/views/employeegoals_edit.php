<?php
include_once("../db.php"); // Include the Database class file
include_once("../employeeGoals.php");



if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch student data by ID from the database
    $db = new Database();
    $employeegoals = new EmployeeGoals($db);
    $employeegoalsData = $employeegoals->read($id); // Implement the read method in the Student class

    if ($employeegoalsData) {
        
    } else {
        echo "Employee Goals not found.";
    }
} else {
    echo "Employee Goals ID not provided.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        'goal_id' => $_POST['goal_id'],
        'employee_id' => $_POST['employee_id'],
        'goal_description' => $_POST['goal_description'],
        'target_completion_date' => $_POST['target_completion_date']     
    ];

    $db = new Database();
    $employeegoals = new EmployeeGoals($db);

    // Call the edit method to update the student data
    if ($employeegoals->update($id, $data)) {
        echo "Record updated successfully.";
    } else {
        echo "Failed to update the record.";
    }
    header("Location: employeegoals_view.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">

    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <title class="record-title">Edit Employee Goals</title>
</head>
<body>
    <!-- Include the header and navbar -->
    <?php include('../templates/header.html'); ?>
    <?php include('../includes/navbar.php'); ?>

    <div class="content">
    <h2>Edit Employee Goals</h2>
    <form action="" method="post">
        <input type="hidden" name="goal_id" value="<?php echo $employeegoalsData['goal_id']; ?>">

        <label for="employee_id">Employee ID:</label>
        <input type="number" name="employee_id" id="employee_id" value="<?php echo $employeegoalsData['employee_id']; ?>">

        <label for="goal_description">Goal Description:</label>
        <input type="text" name="goal_description" id="goal_description" value="<?php echo $employeegoalsData['goal_description']; ?>">

        <label for="target_completion_date">Target Completion Date:</label>
        <input type="date" name="target_completion_date" id="target_completion_date" value="<?php echo $employeegoalsData['target_completion_date']; ?>">

        <input type="submit" value="Update">
    </form>
    </div>
    <?php include('../templates/footer.html'); ?>
</body>
</html>
