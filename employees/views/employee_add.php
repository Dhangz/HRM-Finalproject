<?php
include_once("../db.php"); // Include the Database class file
include_once("../employee.php"); // Include the Employee class file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $data = [
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
      'contactno' => $_POST['contactno'],
      'email' => $_POST['email'],
  ];

  // Instantiate the Database and Employee classes
  $database = new Database();
  $employee = new Employee($database);
  $employee_id = $employee->create($data);

  if ($employee_id) {
      echo "Record inserted successfully.";
      header("Location: employee_view.php");
      exit();
  } else {
      echo "Failed to insert the record.";
  }
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" type="text/css" href="../css/styles.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap"
    />
    <title class="record-title">Add Employee Data</title>
  </head>
  <body>
    <!-- Include the header and navbar -->
    <?php include('../templates/header.html'); ?>
    <?php include('../includes/navbar.php'); ?>

    <div class="content">
      <h2>Add Employee Data</h2>
      <form action="" method="post" class="centered-form">
        
        <h3>Personal Information</h3>
        <div class="row">
          <div class="input-fields">
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name" required />
          </div>

          <div class="input-fields">
            <label for="middle_name">Middle Name:</label>
            <input type="text" name="middle_name" id="middle_name" />
          </div>

          <div class="input-fields">
            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" id="last_name" required />
          </div>
        </div>

        <div class="row">
          <div class="input-fields">
            <label for="employee_no">Employee Number:</label>
            <input type="number" name="employee_no" id="employee_no" required />
          </div>

          <div class="input-fields">
            <label for="name_extension">Name Extension:</label>
            <select name="name_extension" id="name_extension" required>
              <option value="">--SELECT--</option>
              <option value="Jr">Jr</option>
              <option value="Sr">Sr</option>
              <option value="II">II</option>
              <option value="III">III</option>
            </select>
          </div>
          <div class="input-fields">
            <label for="birthdate">Birthdate:</label>
            <input type="date" name="birthdate" id="birthdate" required />
          </div>
        </div>
        <div class="row">
          <div class="input-fields">
            <label for="sex">Sex:</label>
            <select name="sex" id="sex" required>
              <option value="M">Male</option>
              <option value="F">Female</option>
            </select>
          </div>
          <div class="input-fields">
            <label for="citizenship">Citizenship:</label>
            <select name="citizenship" id="citizenship" required>
              <option value="Filipino">Filipino</option>
              <option value="Dual Citizen">Dual Citizen</option>
              <option value="By birth">By birth</option>
              <option value="By naturalization">By naturalization</option>
            </select>
          </div>

          <div class="input-fields">
            <label for="civil_status" style="width: 100px">Civil Status:</label>
            <select name="civil_status" id="civil_status" required>
              <option value="Single">Single</option>
              <option value="Married">Married</option>
              <option value="Widowed">Widowed</option>
              <option value="Separated">Separated</option>
              <option value="Others">Others</option>
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
              required
            />
          </div>

          <div class="input-fields">
            <label for="height_in_meter">Height (in meter):</label>
            <input
              type="number"
              name="height_in_meter"
              id="height_in_meter"
              required
            />
          </div>

          <div class="input-fields">
            <label for="blood_type">Blood Type:</label>
            <input type="text" name="blood_type" id="blood_type" required />
          </div>
        </div>

        <div class="row">
          <div class="input-fields">
            <label for="birth_city">Birth City:</label>
            <input type="text" name="birth_city" id="birth_city" required />
          </div>

          <div class="input-fields">
            <label for="birth_province">Birth Province:</label>
            <input
              type="text"
              name="birth_province"
              id="birth_province"
              required
            />
          </div>

          <div class="input-fields">
            <label for="birth_country">Birth Country:</label>
            <input
              type="text"
              name="birth_country"
              id="birth_country"
              required
            />
          </div>
        </div>

        <div class="row">
          <div class="input-fields">
            <label for="contactno">Mobile Number:</label>
            <input type="number" name="contactno" id="contactno" required />
          </div>
          <div class="input-fields">
            <label for="telephone">Telephone:</label>
            <input type="number" name="telephone" id="telephone" required />
          </div>
          <div class="input-fields">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required />
          </div>
        </div>

        <h3>Other Details:</h3>
        <div class="row">
          <div class="input-fields">
            <label for="philhealthno">PHILHEALTH No:</label>
            <input type="number" name="philhealthno" id="philhealthno" required />
          </div>
          <div class="input-fields">
            <label for="gsis_no">GSIS No:</label>
            <input type="number" name="gsis_no" id="gsis_no" required />
          </div>

          <div class="input-fields">
            <label for="tin">TIN:</label>
            <input type="number" name="tin" id="tin" required />
          </div>

          <div class="input-fields">
            <label for="sss_no">SSS:</label>
            <input type="number" name="sss_no" id="sss_no" required />
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
              required
            />
          </div>
          <div class="input-fields">
            <label for="res_street_address">Residential Street Address:</label>
            <input
              type="text"
              name="res_street_address"
              id="res_street_address"
              required
            />
          </div>

          <div class="input-fields">
            <label for="res_vill_address">Residential Village Address:</label>
            <input
              type="text"
              name="res_vill_address"
              id="res_vill_address"
              required
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
              required
            />
          </div>
          <div class="input-fields">
            <label for="res_city">Residential City:</label>
            <input type="text" name="res_city" id="res_city" required />
          </div>
        </div>

        
        <div class="column">
          <div class="input-fields">
            <label for="res_municipality">Residential Municipality:</label>
            <input
              type="text"
              name="res_municipality"
              id="res_municipality"
              required
            />
          </div>

          <div class="input-fields">
            <label for="res_province">Residential Province:</label>
            <input type="text" name="res_province" id="res_province" required />
          </div>

          <div class="input-fields">
            <label for="res_zipcode">Residential Zip Code:</label>
            <input type="number" name="res_zipcode" id="res_zipcode" required />
          </div>

          <div class="input-fields">
            <label for="perm_spec_address">Permanent Specific Address:</label>
            <input
              type="text"
              name="perm_spec_address"
              id="perm_spec_address"
              required
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
              required
            />
          </div>

          <div class="input-fields">
            <label for="perm_vill_address">Permanent Village Address:</label>
            <input
              type="text"
              name="perm_vill_address"
              id="perm_vill_address"
              required
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
              required
            />
          </div>

          <div class="input-fields">
            <label for="perm_city">Permanent City:</label>
            <input type="text" name="perm_city" id="perm_city" required />
          </div>
        </div>

        <div class="column">
          <div class="input-fields">
            <label for="perm_municipality">Permanent Municipality:</label>
            <input
              type="text"
              name="perm_municipality"
              id="perm_municipality"
              required
            />
          </div>

          <div class="input-fields">
            <label for="perm_province">Permanent Province:</label>
            <input
              type="text"
              name="perm_province"
              id="perm_province"
              required
            />
          </div>

          <div class="input-fields">
            <label for="perm_zipcode">Permanent Zip Code:</label>
            <input type="text" name="perm_zipcode" id="perm_zipcode" required />
          </div>
        </div>

        <input type="submit" value="Add Employee">

      </form>
    </div>

    <?php include('../templates/footer.html'); ?>
  </body>
</html>
