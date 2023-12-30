<?php
include_once("../db.php"); // Include the Database class file
include_once("../employeeGoals.php");




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [    
    'employee_id' => $_POST['employee_id'],
    'goal_description' => $_POST['goal_description'],
    'target_completion_date' => $_POST['target_completion_date'], 
    ];

    // Instantiate the Database and Student classes
    $database = new Database();
    $employeegoals = new EmployeeGoals($database);
    $id = $employeegoals->create($data);
    
    header("Location: employeegoals_view.php");
    
}


?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <title>Add Employee Goals </title>
</head>
<body>
    <!-- Include the header and navbar -->
    <?php include('../templates/header.html'); ?>
    <?php include('../includes/navbar.php'); ?>

    <div class="content">
    <h1 class="record-title">Add Employee Goals</h1>
    <form action="" method="post" class="centered-form">

        <div class="column">
          <div class="input-fields">
            <label for="employee_id">Employee ID:</label>
            <input type="number" name="employee_id" id="employee_id">
          </div>

          <div class="input-fields">
            <label for="goal_description">Goal Description:</label>
            <input type="text" name="goal_description" id="goal_description">

          </div>

          <div class="input-fields">
            <label for="target_completion_date">Target Completion Date:</label>
            <input type="date" name="target_completion_date" id="target_completion_date">
          </div>
        </div>
        <input type="submit" value="Add Employee Goals">
    </form>
    </div>
    
    <?php include('../templates/footer.html'); ?>
</body>
</html>
