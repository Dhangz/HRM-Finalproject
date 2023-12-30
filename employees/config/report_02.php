<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/styles.css">
  <script
src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js">
</script>
  <title>Report 02</title>
</head>
<body>

<?php include('../templates/header.html'); ?>
<?php include('../includes/navbar.php'); ?>
<div class="content">
    <div class="col-md-6">
    <div class="card ">
        <div class="header">
        <h4 class="title">Goal Progress Statistic Report</h4>
        <p class="category">Goal Progress</p>
        </div>
        <div id="report02" class="reports-content">
        <canvas id="myChartTopFive"></canvas>
</div>


<?php
require('config.php');
require('db_conn.php');

$query04 = "SELECT goalprogress.status AS status, COUNT(*) AS status_count
            FROM goalprogress
            JOIN employeegoals ON employeegoals.goal_id = goalprogress.progress_id
            GROUP BY goalprogress.progress_id
            ORDER BY status_count DESC, goalprogress.status
            LIMIT 3;";

$result04 = mysqli_query($conn, $query04);

if ($result04) {
    $status_count = array();
    $status = array();

    while ($row = mysqli_fetch_array($result04)) {
        $status_count[] = $row['status_count'];
        $status[] = $row['status'];
    }

    mysqli_free_result($result04);
    mysqli_close($conn);
} else {
    echo "Error executing the query: " . mysqli_error($conn);
}

?>

<script>

const label_barchart = <?php echo json_encode($status); ?>;
const data4 = {
    labels: label_barchart,
    datasets: [{
        label: 'Goal Progress',
        data: <?php echo json_encode($status_count); ?>,
        backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1
    }]
};

// <!-- config block -->
const config4 = {
    type: 'bar',
    data: data4,
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
};

// <!-- render block -->
const myChartTopFive = new Chart(
    document.getElementById('myChartTopFive'),
    config4
);
</script>
  
</body>
</html>