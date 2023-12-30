<?php
include_once("../db.php"); // Include the Database class file
include_once("../employee.php"); // Include the Employee class file

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch employee data by ID from the database
    $db = new Database();
    $employee = new Employee($db);
    $employeeData = $employee->read($id); // Implement the read method in the Employee class

    if ($employeeData) {
        // The employee data is retrieved, and you can pre-fill the edit form with this data.
    } else {
        echo "Employee not found.";
    }
} else {
    echo "Employee ID not provided.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        'employee_id' => $_POST['employee_id'],
        'employee_no' => $_POST['employee_no'],
        'first_name' => $_POST['first_name'],
        'middle_name' => $_POST['middle_name'],
        'last_name' => $_POST['last_name'],
        'name_extension' => $_POST['name_extension'],
        'birthdate' => $_POST['birthdate'],
        'birth_city' => $_POST['birth_city'],
        'birth_province' => $_POST['birth_province'],
        'birth_country' => $_POST['birth_country'],
        'sex' => $_POST['sex'],
        'civil_status' => $_POST['civil_status'],
        'height_in_meter' => $_POST['height_in_meter'],
        'weight_in_kg' => $_POST['weight_in_kg'],
        'contactno' => $_POST['contactno'],
        'blood_type' => $_POST['blood_type'],
        'gsis_no' => $_POST['gsis_no'],
        'sss_no' => $_POST['sss_no'],
        'philhealthno' => $_POST['philhealthno'],
        'tin' => $_POST['tin'],
        'citizenship' => $_POST['citizenship'],
        'res_spec_address' => $_POST['res_spec_address'],
        'res_street_address' => $_POST['res_street_address'],
        'res_vill_address' => $_POST['res_vill_address'],
        'res_barangay_address' => $_POST['res_barangay_address'],
        'res_city' => $_POST['res_city'],
        'res_municipality' => $_POST['res_municipality'],
        'res_province' => $_POST['res_province'],
        'res_zipcode' => $_POST['res_zipcode'],
        'perm_spec_address' => $_POST['perm_spec_address'],
        'perm_street_address' => $_POST['perm_street_address'],
        'perm_vill_address' => $_POST['perm_vill_address'],
        'perm_barangay_address' => $_POST['perm_barangay_address'],
        'perm_city' => $_POST['perm_city'],
        'perm_municipality' => $_POST['perm_municipality'],
        'perm_province' => $_POST['perm_province'],
        'perm_zipcode' => $_POST['perm_zipcode'],
        'telephone' => $_POST['telephone'],
        'email' => $_POST['email'],
    ];

    $db = new Database();
    $employee = new Employee($db);

    if ($employee->update($id, $data)) {
        // Fetch the updated data from the database
        $employeeData = $employee->read($id);
        echo "Record updated successfully.";
    } else {
        echo "Failed to update the record.";
    }
    header("Location: employee_view.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <title class="record-title">Edit Employee</title>
</head>
<body>
    <!-- Include the header and navbar -->
    <?php include('../templates/header.html'); ?>
    <?php include('../includes/navbar.php'); ?>

    <div class="content">
      <h2>Add Employee Data</h2>
      <form action="" method="post" class="centered-form">
        
        <h3>Personal Information</h3>
        
        <input type="hidden" name="employee_id" id="employee_id" value="<?php echo $employeeData['id']; ?>" />

        <div class="row">
          <div class="input-fields">
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name" value="<?php echo $employeeData['first_name']; ?>" />
          </div>

          <div class="input-fields">
            <label for="middle_name">Middle Name:</label>
            <input type="text" name="middle_name" id="middle_name" value="<?php echo $employeeData['middle_name']; ?>" />
          </div>

          <div class="input-fields">
            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" id="last_name" value="<?php echo $employeeData['last_name']; ?>" />
          </div>
        </div>

        <div class="row">
          <div class="input-fields">
            <label for="employee_no">Employee Number:</label>
            <input type="number" name="employee_no" id="employee_no" value="<?php echo $employeeData['employee_no']; ?>" />
          </div>

          <div class="input-fields">
            <label for="name_extension">Name Extension:</label>
            <select name="name_extension" id="name_extension" >
              <option value="">--SELECT--</option>
              <option value="Jr" <?php echo $employeeData['name_extension'] == 'Jr' ? 'selected' : ''; ?>>Jr</option>
              <option value="Sr" <?php echo $employeeData['name_extension'] == 'Sr' ? 'selected' : ''; ?>>Sr</option>
              <option value="II" <?php echo $employeeData['name_extension'] == 'II' ? 'selected' : ''; ?>>II</option>
              <option value="III" <?php echo $employeeData['name_extension'] == 'III' ? 'selected' : ''; ?>>III</option>
            </select>
          </div>
          <div class="input-fields">
            <label for="birthdate">Birthdate:</label>
            <input type="date" name="birthdate" id="birthdate" value="<?php echo $employeeData['birthdate']; ?>" />
          </div>
        </div>
        <div class="row">
          <div class="input-fields">
            <label for="sex">Sex:</label>
            <select name="sex" id="sex" required>
              <option value="M" <?php echo $employeeData['sex'] == 'M' ? 'selected' : ''; ?>>Male</option>
              <option value="F" <?php echo $employeeData['sex'] == 'F' ? 'selected' : ''; ?>>Female</option>
            </select>
          </div>
          <div class="input-fields">
            <label for="citizenship">Citizenship:</label>
            <select name="citizenship" id="citizenship" required>
              <option value="Filipino" <?php echo $employeeData['citizenship'] == 'Filipino' ? 'selected' : ''; ?>>Filipino</option>
              <option value="Dual Citizen" <?php echo $employeeData['citizenship'] == 'Dual Citizen' ? 'selected' : ''; ?>>Dual Citizen</option>
              <option value="By birth" <?php echo $employeeData['citizenship'] == 'By birth' ? 'selected' : ''; ?>>By birth</option>
              <option value="By naturalization" <?php echo $employeeData['citizenship'] == 'By naturalization' ? 'selected' : ''; ?>>By naturalization</option>
            </select>
          </div>

          <div class="input-fields">
            <label for="civil_status" style="width: 100px">Civil Status:</label>
            <select name="civil_status" id="civil_status" required>
              <option value="Single" <?php echo $employeeData['civil_status'] == 'Single' ? 'selected' : ''; ?>>Single</option>
              <option value="Married" <?php echo $employeeData['civil_status'] == 'Married' ? 'selected' : ''; ?>>Married</option>
              <option value="Widowed" <?php echo $employeeData['civil_status'] == 'Widowed' ? 'selected' : ''; ?>>Widowed</option>
              <option value="Separated" <?php echo $employeeData['civil_status'] == 'Separated' ? 'selected' : ''; ?>>Separated</option>
              <option value="Others" <?php echo $employeeData['civil_status'] == 'Others' ? 'selected' : ''; ?>>Others</option>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="input-fields">
            <label for="weight_in_kg">Weight (in kg):</label>
            <input
              type="number"
              name="weight_in_kg"
              id="weight_in_kg"
              value="<?php echo $employeeData['weight_in_kg']; ?>"
            />
          </div>

          <div class="input-fields">
            <label for="height_in_meter">Height (in meter):</label>
            <input
              type="number"
              name="height_in_meter"
              id="height_in_meter"
              value="<?php echo $employeeData['height_in_meter']; ?>"
            />
          </div>

          <div class="input-fields">
            <label for="blood_type">Blood Type:</label>
            <input type="text" name="blood_type" id="blood_type" value="<?php echo $employeeData['blood_type']; ?>" />
          </div>
        </div>

        <div class="row">
          <div class="input-fields">
            <label for="birth_city">Birth City:</label>
            <input type="text" name="birth_city" id="birth_city" value="<?php echo $employeeData['birth_city']; ?>" />
          </div>

          <div class="input-fields">
            <label for="birth_province">Birth Province:</label>
            <input
              type="text"
              name="birth_province"
              id="birth_province"
              value="<?php echo $employeeData['birth_province']; ?>"
            />
          </div>

          <div class="input-fields">
            <label for="birth_country">Birth Country:</label>
            <input
              type="text"
              name="birth_country"
              id="birth_country"
              value="<?php echo $employeeData['birth_country']; ?>"
            />
          </div>
        </div>

        <div class="row">
          <div class="input-fields">
            <label for="contactno">Mobile Number:</label>
            <input type="text" name="contactno" id="contactno" value="<?php echo $employeeData['contactno']; ?>"/>
          </div>

          <div class="input-fields">
            <label for="telephone">Telephone:</label>
            <input type="text" name="telephone" id="telephone" value="<?php echo $employeeData['telephone']; ?>" />
          </div>

          <div class="input-fields">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo $employeeData['email']; ?>" />
          </div>
        </div>

        <h3>Other Details:</h3>
        <div class="row">
          <div class="input-fields">
            <label for="philhealthno">PHILHEALTH No:</label>
            <input type="number" name="philhealthno" id="philhealthno" value="<?php echo $employeeData['philhealthno']; ?>" />
          </div>
          <div class="input-fields">
            <label for="gsis_no">GSIS No:</label>
            <input type="number" name="gsis_no" id="gsis_no" value="<?php echo $employeeData['gsis_no']; ?>" />
          </div>

          <div class="input-fields">
            <label for="tin">TIN:</label>
            <input type="number" name="tin" id="tin" value="<?php echo $employeeData['tin']; ?>" />
          </div>

          <div class="input-fields">
            <label for="sss_no">SSS:</label>
            <input type="number" name="sss_no" id="sss_no" value="<?php echo $employeeData['sss_no']; ?>" />
          </div>
        </div>

        <h3>Address</h3>
        <div class="column">
          <div class="input-fields">
            <label for="res_spec_address">Residential Specific Address:</label>
            <input
              type="text"
              name="res_spec_address"
              id="res_spec_address"
              value="<?php echo $employeeData['res_spec_address']; ?>"
            />
          </div>
          <div class="input-fields">
            <label for="res_street_address">Residential Street Address:</label>
            <input
              type="text"
              name="res_street_address"
              id="res_street_address"
              value="<?php echo $employeeData['res_street_address']; ?>"
            />
          </div>

          <div class="input-fields">
            <label for="res_vill_address">Residential Village Address:</label>
            <input
              type="text"
              name="res_vill_address"
              id="res_vill_address"
              value="<?php echo $employeeData['res_vill_address']; ?>"
            />
          </div>

          <div class="input-fields">
            <label for="res_barangay_address"
              >Residential Barangay Address:</label
            >
            <input
              type="text"
              name="res_barangay_address"
              id="res_barangay_address"
              value="<?php echo $employeeData['res_barangay_address']; ?>"
            />
          </div>
          <div class="input-fields">
            <label for="res_city">Residential City:</label>
            <input type="text" name="res_city" id="res_city" value="<?php echo $employeeData['res_city']; ?>"/>
          </div>
        </div>

        
        <div class="column">
          <div class="input-fields">
            <label for="res_municipality">Residential Municipality:</label>
            <input
              type="text"
              name="res_municipality"
              id="res_municipality"
              value="<?php echo $employeeData['res_municipality']; ?>"
            />
          </div>

          <div class="input-fields">
            <label for="res_province">Residential Province:</label>
            <input type="text" name="res_province" id="res_province" value="<?php echo $employeeData['res_province']; ?>" />
          </div>

          <div class="input-fields">
            <label for="res_zipcode">Residential Zip Code:</label>
            <input type="number" name="res_zipcode" id="res_zipcode" value="<?php echo $employeeData['res_zipcode']; ?>" />
          </div>

          <div class="input-fields">
            <label for="perm_spec_address">Permanent Specific Address:</label>
            <input
              type="text"
              name="perm_spec_address"
              id="perm_spec_address"
              value="<?php echo $employeeData['perm_spec_address']; ?>"
            />
          </div>
        </div>

        <div class="column">
          <div class="input-fields">
            <label for="perm_street_address">Permanent Street Address:</label>
            <input
              type="text"
              name="perm_street_address"
              id="perm_street_address"
              value="<?php echo $employeeData['perm_street_address']; ?>"
            />
          </div>

          <div class="input-fields">
            <label for="perm_vill_address">Permanent Village Address:</label>
            <input
              type="text"
              name="perm_vill_address"
              id="perm_vill_address"
              value="<?php echo $employeeData['perm_vill_address']; ?>"
            />
          </div>

          <div class="input-fields">
            <label for="perm_barangay_address"
              >Permanent Barangay Address:</label
            >
            <input
              type="text"
              name="perm_barangay_address"
              id="perm_barangay_address"
              value="<?php echo $employeeData['perm_barangay_address']; ?>"
            />
          </div>

          <div class="input-fields">
            <label for="perm_city">Permanent City:</label>
            <input type="text" name="perm_city" id="perm_city" value="<?php echo $employeeData['perm_city']; ?>" />
          </div>
        </div>

        <div class="column">
          <div class="input-fields">
            <label for="perm_municipality">Permanent Municipality:</label>
            <input
              type="text"
              name="perm_municipality"
              id="perm_municipality"
              value="<?php echo $employeeData['perm_municipality']; ?>"
            />
          </div>

          <div class="input-fields">
            <label for="perm_province">Permanent Province:</label>
            <input
              type="text"
              name="perm_province"
              id="perm_province"
              value="<?php echo $employeeData['perm_province']; ?>"
            />
          </div>

          <div class="input-fields">
            <label for="perm_zipcode">Permanent Zip Code:</label>
            <input type="text" name="perm_zipcode" id="perm_zipcode" value="<?php echo $employeeData['perm_zipcode']; ?>" />
          </div>
        </div>

        <input type="submit" value="Add Employee">

      </form>
    </div>
    <?php include('../templates/footer.html'); ?>
</body>
</html>
