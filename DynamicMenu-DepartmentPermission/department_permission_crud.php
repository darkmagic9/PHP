<?php
header('Content-Type: application/json');
include 'database.php';

if (!isset($_POST['searchTerm'])) {

    // Fetch records
    $departmentlistqry = "SELECT * FROM `department` where department_status='Enable'";
} else {

    $search = $_POST['searchTerm']; // Search text

    // Fetch records
    $departmentlistqry = "SELECT * FROM `department` where department_status='Enable' AND department_name LIKE '%$search%'";
}

$departmentlistres = mysqli_query($con, $departmentlistqry);
$json = [];
while ($departmentdata = mysqli_fetch_assoc($departmentlistres)) {
    $json[] = ['id' => $departmentdata['department_id'], 'text' => $departmentdata['department_name']];
}
echo json_encode($json);

