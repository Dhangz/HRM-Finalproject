<?php
include_once("../db.php"); // Include the Database class file
include_once("../goalprogress.php");




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [    
    'goal_id' => $_POST['goal_id'],
    'actual_completion_date' => $_POST['actual_completion_date'],
    'status' => $_POST['status'],
    'comments' => $_POST['comments']
    ];

    // Instantiate the Database and Student classes
    $database = new Database();
    $goalprogress = new GoalProgress($database);
    $progress_id = $goalprogress->create($data);
    
    header("Location: goalprogress_view.php");     
    
}
?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <title>Add Goal Progress</title>
</head>
<body>
    <!-- Include the header and navbar -->
    <?php include('../templates/header.html'); ?>
    <?php include('../includes/navbar.php'); ?>

    <div class="content">
    <h1 class="record-title">Add Goal Progress</h1>
    <form action="" method="post" class="centered-form">

        <div class="column">
          <div class="input-fields">
            <label for="goal_id">Goal ID:</label>
            <input type="number" name="goal_id" id="goal_id">
          </div>

          <div class="input-fields">
            <label for="actual_completion_date">Actual Completion Date:</label>
            <input type="date" name="actual_completion_date" id="actual_completion_date">

          </div>

          <div class="input-fields">
            <label for="status">Status</label>
            <select name="status" id="status" required>
              <option value="">--SELECT--</option>
              <option value="In Progress">In Progress</option>
              <option value="Completed">Completed</option>
              <option value="Overdue">Overdue</option>
            </select>
          </div>

          <div class="input-fields">
            <label for="comments">Comments</label>
            <input type="text" name="comments" id="comments">
          </div>
        </div>
        <input type="submit" value="Add Goal Progress">
    </form>
    </div>
    
    <?php include('../templates/footer.html'); ?>
</body>
</html>
