<?php
include_once("../db.php");
include_once("../employee.php"); // Assuming you have an employee class


$db = new Database();
$connection = $db->getConnection();
$employee = new Employee($db); // Make sure to have an Employee class

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $searchTerm = $_GET['search'];
    $results = $employee->searchEmployees($searchTerm); // Assuming you have a searchEmployees method
} else {
    // If no search term, display all employees
    $results = $employee->displayAll();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Employee Records</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" />
</head>
<body>
    <!-- Include the header -->
    <?php include('../templates/header.html'); ?>
    <?php include('../includes/navbar.php'); ?>

    <div class="content">
        <h2 class="record-title">Employees Record</h2>
        <div class="search-bar">
            <form action="" method="GET">
                <input style="width: 250px; margin-top: 20px; background-color: white;" type="text" id="search" name="search" placeholder="Enter employee name">
                <button class="button-link" type="submit">Search</button>
            </form>
        </div>

        <table class="orange-theme">
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Employee No</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Name Extension</th>
                    <th>Birthdate</th>
                    <th>Birth City</th>
                    <th>Birth Province</th>
                    <th>Birth Country</th>
                    <th>Sex</th>
                    <th>Civil Status</th>
                    <th>Height (m)</th>
                    <th>Weight (kg)</th>
                    <th>Contact No</th>
                    <th>Blood Type</th>
                    <th>GSIS No</th>
                    <th>SSS No</th>
                    <th>PHILHEALTH No</th>
                    <th>TIN No</th>    
                    <th>Citizenship</th>
                    <th>res_spec_address</th>
                    <th>res_street_address</th>
                    <th>res_vill_address</th>
                    <th>res_barangay_address</th>
                    <th>res_city</th>
                    <th>res_municipality</th>
                    <th>res_province</th>
                    <th>res_zipcode</th>
                    <th>perm_spec_address</th>
                    <th>perm_street_address</th>
                    <th>perm_vill_address</th>
                    <th>perm_barangay_address</th>
                    <th>perm_city</th>
                    <th>perm_municipality</th>
                    <th>perm_province</th>
                    <th>perm_zipcode</th>
                    <th>telephone</th>
                    <th>email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $result) { ?>
                    <tr>
                        <td><?php echo $result['employee_id']; ?></td>
                        <td><?php echo $result['employee_no']; ?></td>
                        <td><?php echo $result['first_name']; ?></td>
                        <td><?php echo $result['middle_name']; ?></td>
                        <td><?php echo $result['last_name']; ?></td>
                        <td><?php echo $result['name_extension']; ?></td>
                        <td><?php echo $result['birthdate']; ?></td>
                        <td><?php echo $result['birth_city']; ?></td>
                        <td><?php echo $result['birth_province']; ?></td>
                        <td><?php echo $result['birth_country']; ?></td>
                        <td><?php echo $result['sex']; ?></td>
                        <td><?php echo $result['civil_status']; ?></td>
                        <td><?php echo $result['height_in_meter']; ?></td>
                        <td><?php echo $result['weight_in_kg']; ?></td>
                        <td><?php echo $result['contactno']; ?></td>
                        <td><?php echo $result['blood_type']; ?></td>
                        <td><?php echo $result['gsis_no']; ?></td>
                        <td><?php echo $result['sss_no']; ?></td>
                        <td><?php echo $result['philhealthno']; ?></td>
                        <td><?php echo $result['tin']; ?></td>                        
                        <td><?php echo $result['citizenship']; ?></td>
                        <td><?php echo $result['res_spec_address']; ?></td>
                        <td><?php echo $result['res_street_address']; ?></td>
                        <td><?php echo $result['res_vill_address']; ?></td>
                        <td><?php echo $result['res_barangay_address']; ?></td>
                        <td><?php echo $result['res_city']; ?></td>
                        <td><?php echo $result['res_municipality']; ?></td>
                        <td><?php echo $result['res_province']; ?></td>
                        <td><?php echo $result['res_zipcode']; ?></td>
                        <td><?php echo $result['perm_spec_address']; ?></td>
                        <td><?php echo $result['perm_street_address']; ?></td>
                        <td><?php echo $result['perm_vill_address']; ?></td>
                        <td><?php echo $result['perm_barangay_address']; ?></td>
                        <td><?php echo $result['perm_city']; ?></td>
                        <td><?php echo $result['perm_municipality']; ?></td>
                        <td><?php echo $result['perm_province']; ?></td>
                        <td><?php echo $result['perm_zipcode']; ?></td>
                        <td><?php echo $result['telephone']; ?></td>
                        <td><?php echo $result['email']; ?></td>

                        <td>
                            <a class="edit-button" href="employee_edit.php?id=<?php echo $result['employee_id']; ?>">Edit</a>
                            
                            <a class="delete-button" href="employee_delete.php?id=<?php echo $result['employee_id']; ?>">Delete</a>
                        </td>
                        

                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <a class="button-link" href="employee_add.php">Add New Record</a>
    </div>

    <!-- Include the footer -->
    <?php include('../templates/footer.html'); ?>

    <p></p>
</body>
</html>
