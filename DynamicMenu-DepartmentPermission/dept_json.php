<?php 
header('Content-Type: application/json; charset=utf-8');

include 'database.php';

if (isset($_GET['searchTerm'])) {
    $departmentlistqry = "SELECT * FROM `department` where department_status='Enable' AND department_name LIKE '%". $_GET['searchTerm']. "%'";
} else {
    $departmentlistqry = "SELECT * FROM `department` where department_status='Enable'";
}

$departmentlistres = mysqli_query($con, $departmentlistqry);
$data2 = array();
while ($departmentdata = mysqli_fetch_assoc($departmentlistres)) {
    $data = [
        'id' => $departmentdata['department_id'],
        'text' => $departmentdata['department_name']
    ];    
    array_push($data2, $data);
}
$respons = array(
    'status'=> true,
    'data' => $data2,
    'message' => 'Get data success'
);

echo json_encode($respons);

?>