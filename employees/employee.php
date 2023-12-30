<?php
include_once("db.php"); // Include the file with the Database class

class Employee {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($data) {
        try {
            // Prepare the SQL INSERT statement
            $sql = "INSERT INTO employees(employee_id, first_name, middle_name, last_name, name_extension, birthdate, birth_city, birth_province, birth_country, sex, civil_status, height_in_meter, weight_in_kg, contactno, blood_type, gsis_no, sss_no, philhealthno, tin, employee_no, citizenship, res_spec_address, res_street_address, res_vill_address, res_barangay_address, res_city, res_municipality, res_province, res_zipcode, perm_spec_address, perm_street_address, perm_vill_address, perm_barangay_address, perm_city, perm_municipality, perm_province, perm_zipcode, telephone, email) 
            VALUES(:employee_id, :first_name, :middle_name, :last_name, :name_extension, :birthdate, :birth_city, :birth_province, :birth_country, :sex, :civil_status, :height_in_meter, :weight_in_kg, :contactno, :blood_type, :gsis_no, :sss_no, :philhealthno, :tin, :employee_no, :citizenship, :res_spec_address, :res_street_address, :res_vill_address, :res_barangay_address, :res_city, :res_municipality, :res_province, :res_zipcode, :perm_spec_address, :perm_street_address, :perm_vill_address, :perm_barangay_address, :perm_city, :perm_municipality, :perm_province, :perm_zipcode, :telephone, :email);";
            $stmt = $this->db->getConnection()->prepare($sql);

            // Bind values to placeholders
            $stmt->bindParam(':employee_id', $data['employee_id']);
            $stmt->bindParam(':first_name', $data['first_name']);
            $stmt->bindParam(':middle_name', $data['middle_name']);
            $stmt->bindParam(':last_name', $data['last_name']);
            $stmt->bindParam(':name_extension', $data['name_extension']);
            $stmt->bindParam(':birthdate', $data['birthdate']);
            $stmt->bindParam(':birth_city', $data['birth_city']);
            $stmt->bindParam(':birth_province', $data['birth_province']);
            $stmt->bindParam(':birth_country', $data['birth_country']);
            $stmt->bindParam(':sex', $data['sex']);
            $stmt->bindParam(':civil_status', $data['civil_status']);
            $stmt->bindParam(':height_in_meter', $data['height_in_meter']);
            $stmt->bindParam(':weight_in_kg', $data['weight_in_kg']);
            $stmt->bindParam(':contactno', $data['contactno']);
            $stmt->bindParam(':blood_type', $data['blood_type']);
            $stmt->bindParam(':gsis_no', $data['gsis_no']);
            $stmt->bindParam(':sss_no', $data['sss_no']);
            $stmt->bindParam(':philhealthno', $data['philhealthno']);
            $stmt->bindParam(':tin', $data['tin']);
            $stmt->bindParam(':employee_no', $data['employee_no']);
            $stmt->bindParam(':citizenship', $data['citizenship']);
            $stmt->bindParam(':res_spec_address', $data['res_spec_address']);
            $stmt->bindParam(':res_street_address', $data['res_street_address']);
            $stmt->bindParam(':res_vill_address', $data['res_vill_address']);
            $stmt->bindParam(':res_barangay_address', $data['res_barangay_address']);
            $stmt->bindParam(':res_city', $data['res_city']);
            $stmt->bindParam(':res_municipality', $data['res_municipality']);
            $stmt->bindParam(':res_province', $data['res_province']);
            $stmt->bindParam(':res_zipcode', $data['res_zipcode']);
            $stmt->bindParam(':perm_spec_address', $data['perm_spec_address']);
            $stmt->bindParam(':perm_street_address', $data['perm_street_address']);
            $stmt->bindParam(':perm_vill_address', $data['perm_vill_address']);
            $stmt->bindParam(':perm_barangay_address', $data['perm_barangay_address']);
            $stmt->bindParam(':perm_city', $data['perm_city']);
            $stmt->bindParam(':perm_municipality', $data['perm_municipality']);
            $stmt->bindParam(':perm_province', $data['perm_province']);
            $stmt->bindParam(':perm_zipcode', $data['perm_zipcode']);
            $stmt->bindParam(':telephone', $data['telephone']);
            $stmt->bindParam(':email', $data['email']);

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
  
          $sql = "SELECT 
          e.employee_id AS id,
          e.first_name,
          e.middle_name,
          e.last_name,
          e.name_extension,
          e.birthdate,
          e.birth_city,
          e.birth_province,
          e.birth_country,
          e.sex,
          e.civil_status,
          e.height_in_meter,
          e.weight_in_kg,
          e.contactno,
          e.blood_type,
          e.gsis_no,
          e.sss_no,
          e.philhealthno,
          e.tin,
          e.employee_no,
          e.citizenship,
          e.res_spec_address,
          e.res_street_address,
          e.res_vill_address,
          e.res_barangay_address,
          e.res_city,
          e.res_municipality,
          e.res_province,
          e.res_zipcode,
          e.perm_spec_address,
          e.perm_street_address,
          e.perm_vill_address,
          e.perm_barangay_address,
          e.perm_city,
          e.perm_municipality,
          e.perm_province,
          e.perm_zipcode,
          e.telephone,
          e.email
          FROM 
              employees e
          WHERE 
              e.employee_id = :id;";
          $stmt = $connection->prepare($sql);
          $stmt->bindValue(':id', $id);
          $stmt->execute();
  
          // Fetch the employee data as an associative array
          $employeeData = $stmt->fetch(PDO::FETCH_ASSOC);
  
          return $employeeData;
      } catch (PDOException $e) {
          echo "Error: " . $e->getMessage();
          throw $e; // Re-throw the exception for higher-level handling
      }
  }

  public function update($id, $data) {
    try {
        $sql = "UPDATE employees e
                SET
                e.first_name = :first_name,
                e.middle_name = :middle_name,
                e.last_name = :last_name,
                e.name_extension = :name_extension,
                e.birthdate = :birthdate,
                e.birth_city = :birth_city,
                e.birth_province = :birth_province,
                e.birth_country = :birth_country,
                e.sex = :sex,
                e.civil_status = :civil_status,
                e.height_in_meter = :height_in_meter,
                e.weight_in_kg = :weight_in_kg,
                e.contactno = :contactno,
                e.blood_type = :blood_type,
                e.gsis_no = :gsis_no,
                e.sss_no = :sss_no,
                e.philhealthno = :philhealthno,
                e.tin = :tin,
                e.employee_no = :employee_no,
                e.citizenship = :citizenship,
                e.res_spec_address = :res_spec_address,
                e.res_street_address = :res_street_address,
                e.res_vill_address = :res_vill_address,
                e.res_barangay_address = :res_barangay_address,
                e.res_city = :res_city,
                e.res_municipality = :res_municipality,
                e.res_province = :res_province,
                e.res_zipcode = :res_zipcode,
                e.perm_spec_address = :perm_spec_address,
                e.perm_street_address = :perm_street_address,
                e.perm_vill_address = :perm_vill_address,
                e.perm_barangay_address = :perm_barangay_address,
                e.perm_city = :perm_city,
                e.perm_municipality = :perm_municipality,
                e.perm_province = :perm_province,
                e.perm_zipcode = :perm_zipcode,
                e.telephone = :telephone,
                e.email = :email
                WHERE e.employee_id = :id";

        $stmt = $this->db->getConnection()->prepare($sql);

        // Bind parameters
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':first_name', $data['first_name']);
        $stmt->bindValue(':middle_name', $data['middle_name']);
        $stmt->bindValue(':last_name', $data['last_name']);
        $stmt->bindValue(':name_extension', $data['name_extension']);
        $stmt->bindValue(':birthdate', $data['birthdate']);
        $stmt->bindValue(':birth_city', $data['birth_city']);
        $stmt->bindValue(':birth_province', $data['birth_province']);
        $stmt->bindValue(':birth_country', $data['birth_country']);
        $stmt->bindValue(':sex', $data['sex']);
        $stmt->bindValue(':civil_status', $data['civil_status']);
        $stmt->bindValue(':height_in_meter', $data['height_in_meter']);
        $stmt->bindValue(':weight_in_kg', $data['weight_in_kg']);
        $stmt->bindValue(':contactno', $data['contactno']);
        $stmt->bindValue(':blood_type', $data['blood_type']);
        $stmt->bindValue(':gsis_no', $data['gsis_no']);
        $stmt->bindValue(':sss_no', $data['sss_no']);
        $stmt->bindValue(':philhealthno', $data['philhealthno']);
        $stmt->bindValue(':tin', $data['tin']);
        $stmt->bindValue(':employee_no', $data['employee_no']);
        $stmt->bindValue(':citizenship', $data['citizenship']);
        $stmt->bindValue(':res_spec_address', $data['res_spec_address']);
        $stmt->bindValue(':res_street_address', $data['res_street_address']);
        $stmt->bindValue(':res_vill_address', $data['res_vill_address']);
        $stmt->bindValue(':res_barangay_address', $data['res_barangay_address']);
        $stmt->bindValue(':res_city', $data['res_city']);
        $stmt->bindValue(':res_municipality', $data['res_municipality']);
        $stmt->bindValue(':res_province', $data['res_province']);
        $stmt->bindValue(':res_zipcode', $data['res_zipcode']);
        $stmt->bindValue(':perm_spec_address', $data['perm_spec_address']);
        $stmt->bindValue(':perm_street_address', $data['perm_street_address']);
        $stmt->bindValue(':perm_vill_address', $data['perm_vill_address']);
        $stmt->bindValue(':perm_barangay_address', $data['perm_barangay_address']);
        $stmt->bindValue(':perm_city', $data['perm_city']);
        $stmt->bindValue(':perm_municipality', $data['perm_municipality']);
        $stmt->bindValue(':perm_province', $data['perm_province']);
        $stmt->bindValue(':perm_zipcode', $data['perm_zipcode']);
        $stmt->bindValue(':telephone', $data['telephone']);
        $stmt->bindValue(':email', $data['email']);

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
        $sqlEmployee = "DELETE FROM employees WHERE employee_id = :id;";
        $stmtEmployee = $connection->prepare($sqlEmployee);
        $stmtEmployee->execute([':id' => $id]); // Bind the parameter directly in execute

        // Check if any rows were affected (employee deleted)
        if ($stmtEmployee->rowCount() > 0) {
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



public function displayAll() {
  try {
      $sql = "SELECT 
          e.employee_id,
          e.first_name,
          e.middle_name,
          e.last_name,
          e.name_extension,
          e.birthdate,
          e.birth_city,
          e.birth_province,
          e.birth_country,
          e.sex,
          e.civil_status,
          e.height_in_meter,
          e.weight_in_kg,
          e.contactno,
          e.blood_type,
          e.gsis_no,
          e.sss_no,
          e.philhealthno,
          e.tin,
          e.employee_no,
          e.citizenship,
          e.res_spec_address,
          e.res_street_address,
          e.res_vill_address,
          e.res_barangay_address,
          e.res_city,
          e.res_municipality,
          e.res_province,
          e.res_zipcode,
          e.perm_spec_address,
          e.perm_street_address,
          e.perm_vill_address,
          e.perm_barangay_address,
          e.perm_city,
          e.perm_municipality,
          e.perm_province,
          e.perm_zipcode,
          e.telephone,
          e.email
      FROM employees e;";

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


public function searchEmployees($searchTerm) {
    $query = "SELECT * FROM employees WHERE 
              CONCAT(first_name, ' ', last_name) LIKE :searchTerm 
              OR employee_no LIKE :searchTerm"; // Add more fields as needed

    $stmt = $this->db->getConnection()->prepare($query);
    $searchTerm = "%$searchTerm%";
    $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}

$employee = new Employee(new Database());
