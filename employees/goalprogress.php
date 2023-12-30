<?php
include_once("db.php"); // Include the file with the Database class


class GoalProgress {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($data) {
        try {
            // Prepare the SQL INSERT statement
            $sql = "INSERT INTO goalprogress(goal_id, actual_completion_date, status, comments) 
                    VALUES(
                    (SELECT goal_id FROM employeegoals WHERE goal_id = :goal_id),
                    :actual_completion_date,
                    :status, 
                    :comments);";

            $stmt = $this->db->getConnection()->prepare($sql);

            // Bind values to placeholders
            $stmt->bindParam(':goal_id', $data['goal_id']);
            $stmt->bindParam(':actual_completion_date', $data['actual_completion_date']);
            $stmt->bindParam(':status', $data['status']);
            $stmt->bindParam(':comments', $data['comments']);

            // Execute the INSERT query
            $stmt->execute();

            // Check if the insert was successful
             
            if($stmt->rowCount() > 0)
            {
                return $this->db->getConnection()->lastInsertId();
            }

        } catch (PDOException $e) {
            // Handle any potential errors here
            echo "Error: " . $e->getMessage();
            throw $e; // Re-throw the exception for higher-level handling
        }
        
    }

    public function read($id) {
        try {
            $connection = $this->db->getConnection();

            $sql = "SELECT goalprogress.progress_id, 
                            employeegoals.goal_id, 
                            goalprogress.actual_completion_date, 
                            goalprogress.status, 
                            goalprogress.comments
                    FROM 
                        goalprogress
                    JOIN 
                        employeegoals  ON employeegoals.goal_id = goalprogress.goal_id
                    WHERE 
                        goalprogress.progress_id = :id;";
                
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            // Fetch the student data as an associative array
            $EmployeeProgressData = $stmt->fetch(PDO::FETCH_ASSOC);

            return $EmployeeProgressData;

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            throw $e; // Re-throw the exception for higher-level handling
        }
    }

    public function update($id, $data) {
        try {
            $sql = "UPDATE goalprogress
                    SET
                        goal_id = :goal_id, 
                        actual_completion_date = :actual_completion_date, 
                        status = :status, 
                        comments = :comments
                    WHERE
                        progress_id = :progress_id";
    
            $stmt = $this->db->getConnection()->prepare($sql);
    
            // Bind parameters
            $stmt->bindValue(':progress_id', $id);
            $stmt->bindValue(':goal_id', $data['goal_id']);  // Corrected binding
            $stmt->bindValue(':actual_completion_date', $data['actual_completion_date']);
            $stmt->bindValue(':status', $data['status']);
            $stmt->bindValue(':comments', $data['comments']);
    
            // Execute the query
            $stmt->execute();
    
            // Return the updated data
            return $this->read($id);
    
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            throw $e; // Re-throw the exception for higher-level handling
        }
    }
    

    public function delete($id) {
        try {
            $this->db->getConnection()->beginTransaction();
    
            // Delete related records in student_details
            $sqlGoalProgress = "DELETE FROM goalprogress WHERE progress_id = :id";
            $stmtlGoalProgress = $this->db->getConnection()->prepare($sqlGoalProgress);
            $stmtlGoalProgress->bindValue(':id', $id);
            $stmtlGoalProgress->execute();
    
    
            $this->db->getConnection()->commit();
    
            // Check if any rows were affected (student deleted)
            if ($stmtlGoalProgress->rowCount() > 0) {
                return true; // Record deleted successfully
            } else {
                return false; // No records were deleted (student_id not found)
            }
        } catch (PDOException $e) {
            $this->db->getConnection()->rollBack();
            echo "Error: " . $e->getMessage();
            throw $e; // Re-throw the exception for higher-level handling
        }
    }
    
    public function displayAll(){
    try {

        $sql = "SELECT
            g.progress_id,
            g.goal_id,
            g.actual_completion_date,
            g.status,
            g.comments

        FROM goalprogress as g
        JOIN employeegoals ON g.goal_id = employeegoals.goal_id";

        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
        
        } catch (PDOException $e) {
            // Handle any potential errors here
            echo "Error: " . $e->getMessage();
            throw $e; // Re-throw the exception for higher-level handling
        }
    }
 
    /*
        sample simple tests
    */
    public function testGoalProgress() {
        $data = [
            'goal_id' => '1',
            'actual_completion_date' => '2025-05-05',
            'status' => 'On Process',
            'comments' => 'One step at a time1',
        ];

        $progress_id = $this->create($data);

        if ($progress_id !== null) {
            echo "Test passed. GoalProgress created with ID: " . $progress_id . PHP_EOL;
            return $progress_id;
        } else {
            echo "Test failed. GoalProgress creation unsuccessful." . PHP_EOL;
        }
    }

    public function testReadGoalProgress($id) {
        $GoalProgressData = $this->read($id);

        if ($GoalProgressData !== false) {
            echo "Test passed. GoalProgress data read successfully: " . PHP_EOL;
            print_r($GoalProgressData);
        } else {
            echo "Test failed. Unable to read GoalProgress data." . PHP_EOL;
        }
    }

    public function testUpdateGoalProgress($id, $data) {
        $success = $this->update($id, $data);

        if ($success) {
            echo "Test passed. GoalProgress data updated successfully." . PHP_EOL;
        } else {
            echo "Test failed. Unable to update GoalProgress data." . PHP_EOL;
        }
    }

    public function testDeleteGoalProgress($id) {
        $deleted = $this->delete($id);

        if ($deleted) {
            echo "Test passed. GoalProgress data deleted successfully." . PHP_EOL;
        } else {
            echo "Test failed. Unable to delete GoalProgress data." . PHP_EOL;
        }
    }
}


$goalprogress = new GoalProgress(new Database());

// // Test the create method
// $progress_id = $goalprogress->testGoalProgress();

// // Test the read method with the created student ID
// $goalprogress->testReadGoalProgress($progress_id);

// // Test the update method with the created student ID and updated data
// $update_data = [
//     'employee_id' => '1',
//     'goal_description' => 'IPCR',
//     'target_completion_date' => '2024-12-12',
// ];
// $student->testUpdateGoalProgress($goal_id, $update_data);

// // Test the delete method with the created student ID
// $employeegoals->testDeleteGoalProgress($goal_id);

?>