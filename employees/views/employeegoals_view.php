<?php
include_once("../db.php");
include_once("../employeeGoals.php");

$db = new Database();
$connection = $db->getConnection();
$employeegoals = new EmployeeGoals($db);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Employee Goals Records</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">

</head>
<body>
    <!-- Include the header -->
    <?php include('../templates/header.html'); ?>
    <?php include('../includes/navbar.php'); ?>

    <div class="content">
    <h2 class="record-title">Employee Goals Records</h2>
    <table class="orange-theme">
        <thead>
            <tr>
                <th>ID</th>  
                <th>Employee ID</th>
                <th>Goal Description</th>  
                <th>Target Completion Date</th>  
                <th>Actions</th>  
            </tr>
        </thead>
        <tbody>
            <!-- You'll need to dynamically generate these rows with data from your database -->
         
            <?php
            $results = $employeegoals->displayAll(); 
            foreach ($results as $result) {
            ?>
            <tr>
                <td><?php echo $result['goal_id']; ?></td>
                <td><?php echo $result['employee_id']; ?></td>
                <td><?php echo $result['goal_description']; ?></td>
                <td><?php echo $result['target_completion_date']; ?></td>
                
                <td>
                    <a class="edit-button" href="employeegoals_edit.php?id=<?php echo $result['goal_id']; ?>">Edit</a>
                    
                    <a class="delete-button" href="employeegoals_delete.php?id=<?php echo $result['goal_id']; ?>">Delete</a>
                </td>
            </tr>
        <?php } ?>

           
        </tbody>
    </table>
        
    <a class="button-link" href="employeegoals_add.php">Add New Record</a>

        </div>
        
        <!-- Include the header -->
  
    <?php include('../templates/footer.html'); ?>



</body>
</html>
