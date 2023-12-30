<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/students-profile/css/styles.css">
    <title>HRM PROJECT</title>
</head>
<body>
    <div class="toggle-btn" onclick="toggleSidebar()">☰</div>

    <div class="sidebar" id="sidebar">
        <div class="logo">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
            <a href="https://www.facebook.com/photo/?fbid=1551680985635402&set=a.148788805924634"><img src="/ADS_FinalProject/employees/images/logo.jpg"  width="80" height="80" alt="Profile Pictures"></a>
            <h2>Obrien Troy D</h2>
        </div>
        <h1>Menu</h1>
        <ul>
            <li><a href="/ADS_FinalProject/employees/index.php">Home</a></li>
            <li><a href="/ADS_FinalProject/employees/views/employee_view.php">Employees</a></li>
            <li><a href="/ADS_FinalProject/employees/views/employeegoals_view.php">Employee Goals</a></li>
            <li><a href="/ADS_FinalProject/employees/views/goalprogress_view.php">Goal Progress</a></li>
            <li class="dropdown">
                <a href="#" class="dropbtn">Reports <span class="icon">&#9660;</span></a>
                <div class="dropdown-content">
                    <a href="/ADS_FinalProject/employees/config/report_01.php">Report 01</a>
                    <a href="/ADS_FinalProject/employees/config/report_02.php">Report 02</a>
                </div>
            </li>
        </ul>
    </div>

    <script>
        function toggleSidebar() {
          const sidebar = document.getElementById("sidebar");
          sidebar.style.left = sidebar.style.left === "0px" ? "-250px" : "0px";
        }
    </script>
</body>
</html>
