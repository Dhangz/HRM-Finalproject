<?php
include_once("../db.php"); // Include the Database class file
include_once("../goalprogress.php");



if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch student data by ID from the database
    $db = new Database();
    $goalprogress = new GoalProgress($db);
    $goalprogressData = $goalprogress->read($id); // Implement the read method in the Student class

    if ($goalprogressData) {
        
    } else {
        echo "Goal Progress not found.";
    }
} else {
    echo "Goal Progress ID not provided.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        'progress_id' => $_POST['progress_id'],
        'goal_id' => $_POST['goal_id'],
        'actual_completion_date' => $_POST['actual_completion_date'],
        'status' => $_POST['status'],
        'comments' => $_POST['comments']
    ];

    $db = new Database();
    $goalprogress = new GoalProgress($db);

    // Call the edit method to update the student data
    if ($goalprogress->update($id, $data)) {
        echo "Record updated successfully.";
    } else {
        echo "Failed to update the record.";
    }
    header("Location: goalprogress_view.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">

    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <title class="record-title">Edit Goal Progress</title>
</head>
<body>
    <!-- Include the header and navbar -->
    <?php include('../templates/header.html'); ?>
    <?php include('../includes/navbar.php'); ?>

    <div class="content">
    <h2>Edit Employee Goals</h2>
    <form action="" method="post">

    <div class="column">
        <div class="input-fields">
            <label for="progress_id">Progress ID:</label>
            <input type="hidden" name="progress_id" id="progress_id" value="<?php  echo $goalprogressData['progress_id']; ?>" />
        </div>

        <div class="input-fields">
            <label for="goal_id">Goal ID:</label>
            <input type="number" name="goal_id" id="goal_id" value="<?php  echo $goalprogressData['goal_id']; ?>" />
        </div>


        <div class="input-fields">
            <label for="actual_completion_date">Actual Completion Date:</label>
            <input type="date" name="actual_completion_date" id="actual_completion_date" value="<?php echo $goalprogressData['actual_completion_date']; ?>" />
        </div>

        <div class="input-fields">
            <label for="status">Status:</label>
            <input type="text" name="status" id="status" value="<?php  echo $goalprogressData['status']; ?>" />
        </div>

        <div class="input-fields">
            <label for="comments">Comments:</label>
            <input type="text" name="comments" id="comments" value="<?php  echo $goalprogressData['goal_id']; ?>"/>
        </div>
    </div>

        <input type="submit" value="Update">
    </form>
    </div>
    <?php include('../templates/footer.html'); ?>
</body>
</html>
