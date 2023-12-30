<?php
include_once("../db.php");
include_once("../goalprogress.php");

$db = new Database();
$connection = $db->getConnection();
$goalprogress = new GoalProgress($db);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Goal Progress</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">

</head>
<body>
    <!-- Include the header -->
    <?php include('../templates/header.html'); ?>
    <?php include('../includes/navbar.php'); ?>

    <div class="content">
    <h2 class="record-title">Goal Progress</h2>
    <table class="orange-theme">
        <thead>
            <tr>
                <th>ID</th>  
                <th>Goal ID</th>
                <th>Actual Completion Date</th>
                <th>Comments</th>
                <th>Status</th> 
                <th>Actions</th> 
            </tr>
        </thead>
        <tbody>
            <!-- You'll need to dynamically generate these rows with data from your database -->
         
            <?php
            $results = $goalprogress->displayAll(); 
            foreach ($results as $result) {
            ?>
            <tr>
                <td><?php echo $result['progress_id']; ?></td>
                <td><?php echo $result['goal_id']; ?></td>
                <td><?php echo $result['actual_completion_date']; ?></td>
                <td><?php echo $result['comments']; ?></td>
                <td><?php echo $result['status']; ?></td>
                
                <td>
                    <a class="edit-button" href="goalprogress_edit.php?id=<?php echo $result['progress_id']; ?>">Edit</a>
                    
                    <a class="delete-button" href="goalprogress_delete.php?id=<?php echo $result['progress_id']; ?>">Delete</a>
                </td>
            </tr>
        <?php } ?>

           
        </tbody>
    </table>
        
    <a class="button-link" href="goalprogress_add.php">Add New Record</a>

        </div>
  
    <?php include('../templates/footer.html'); ?>



</body>
</html>
