<?php
include_once("db.php"); // Include the file with the Database class


class EmployeeGoals {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($data) {
        try {
            // Prepare the SQL INSERT statement
            $sql = "INSERT INTO employeegoals(employee_id, goal_description, target_completion_date) 
                    VALUES(
                        (SELECT employee_id FROM employees WHERE employee_id = :employee_id),
                        :goal_description,
                        :target_completion_date);";
    
            $stmt = $this->db->getConnection()->prepare($sql);
    
            // Bind values to placeholders
            $stmt->bindParam(':employee_id', $data['employee_id']);  // Corrected binding here
            $stmt->bindParam(':goal_description', $data['goal_description']);
            $stmt->bindParam(':target_completion_date', $data['target_completion_date']);
    
            // Execute the INSERT query
            $stmt->execute();
    
            // Check if the insert was successful
            if ($stmt->rowCount() > 0) {
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
    
            $sql = "SELECT employeegoals.goal_id, 
                           employees.employee_id, 
                           employeegoals.goal_description, 
                           employeegoals.target_completion_date
                    FROM employeegoals 
                    JOIN employees ON employees.employee_id = employeegoals.employee_id
                    WHERE employeegoals.goal_id = :id;";
    
            $stmt = $connection->prepare($sql);
    
            // Use the correct parameter name here
            $stmt->bindValue(':id', $id);
    
            $stmt->execute();
    
            // Fetch the employee goals data as an associative array
            $employeeGoalsData = $stmt->fetch(PDO::FETCH_ASSOC);
    
            return $employeeGoalsData;
    
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            throw $e; // Re-throw the exception for higher-level handling
        }
    }
    

    public function update($id, $data) {
        try {
            $sql = "UPDATE employeegoals
                    SET
                        employee_id = :employee_id,
                        goal_description = :goal_description, 
                        target_completion_date = :target_completion_date
                    WHERE
                        goal_id = :goal_id";
    
            $stmt = $this->db->getConnection()->prepare($sql);
    
            // Bind parameters
            $stmt->bindValue(':goal_id', $id);
            $stmt->bindValue(':employee_id', $data['employee_id']);
            $stmt->bindValue(':goal_description', $data['goal_description']);
            $stmt->bindValue(':target_completion_date', $data['target_completion_date']);
    
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
            $connection = $this->db->getConnection();
            $connection->beginTransaction();
    
            // Delete employee record
            $sqlEmployeegoals = "DELETE FROM employeegoals WHERE goal_id = :id;";
            $stmtEmployeegoals = $connection->prepare($sqlEmployeegoals);
            $stmtEmployeegoals->execute([':id' => $id]); // Bind the parameter directly in execute
    
            // Check if any rows were affected (employee deleted)
            if ($stmtEmployeegoals->rowCount() > 0) {
                $connection->commit();
                return true; // Record deleted successfully
            } else {
                $connection->rollBack();
                return false; // No records were deleted (employee_id not found)
            }
    
        } catch (PDOException $e) {
            $connection->rollBack();
            echo "Error: " . $e->getMessage();
            throw $e; // Re-throw the exception for higher-level handling
        }
    }
    


    public function displayAll(){
        try {
    
            $sql = "SELECT
                    employeegoals.goal_id, 
                    employees.employee_id, 
                    employeegoals.goal_description, 
                    employeegoals.target_completion_date
                FROM employeegoals
                JOIN employees ON employees.employee_id = employeegoals.employee_id";



    
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
    public function testCreateStudent() {
        $data = [
            'employee_id' => '1',
            'goal_description' => 'Monthly Reports of Collection',
            'target_completion_date' => '2023-12-12',
        ];

        $goal_id = $this->create($data);

        if ($goal_id !== null) {
            echo "Test passed. EmployeeGoals created with ID: " . $goal_id . PHP_EOL;
            return $goal_id;
        } else {
            echo "Test failed. EmployeeGoals creation unsuccessful." . PHP_EOL;
        }
    }

    public function testReadStudent($id) {
        $EmployeegoalsData = $this->read($id);

        if ($EmployeegoalsData !== false) {
            echo "Test passed. EmployeeGoals data read successfully: " . PHP_EOL;
            print_r($EmployeegoalsData);
        } else {
            echo "Test failed. Unable to read EmployeeGoals data." . PHP_EOL;
        }
    }

    public function testUpdateStudent($id, $data) {
        $success = $this->update($id, $data);

        if ($success) {
            echo "Test passed. EmployeeGoals data updated successfully." . PHP_EOL;
        } else {
            echo "Test failed. Unable to update EmployeeGoals data." . PHP_EOL;
        }
    }

    public function testDeleteStudent($id) {
        $deleted = $this->delete($id);

        if ($deleted) {
            echo "Test passed. EmployeeGoals data deleted successfully." . PHP_EOL;
        } else {
            echo "Test failed. Unable to delete EmployeeGoals data." . PHP_EOL;
        }
    }
}


// $employeegoals = new EmployeeGoals(new Database());

// // Test the create method
// $goal_id = $employeegoals->testCreateStudent();

// // Test the read method with the created student ID
// $employeegoals->testReadStudent($goal_id);

// // Test the update method with the created student ID and updated data
// $update_data = [
//     'employee_id' => '1',
//     'goal_description' => 'IPCR',
//     'target_completion_date' => '2024-12-12',
// ];
// $student->testUpdateStudent($goal_id, $update_data);

// // Test the delete method with the created student ID
// $employeegoals->testDeleteStudent($goal_id);

?>