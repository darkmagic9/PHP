<?php
header('Content-Type: application/json; charset=utf-8');

include 'database.php';
$respons = [
    [
	'id'=> 1,
	'users_name'=> 'wwwwwwwwwww',
	'users_icon'=> 'dddddddddddd',
    ],
    [
	'id'=> 2,
	'users_name'=> 'bbbbbbb',
	'users_icon'=> 'uuuuuuuu',
    ]
];

if (isset($_POST['action']) && $_POST['action'] == 'listRecords') {
	$departmentslistqry = "SELECT * from department where department_status='Enable'";
	$departmentslistres = mysqli_query($con, $departmentslistqry);
	$respon = [];
    $respons = [];
	while ($departmentsdata = mysqli_fetch_assoc($departmentslistres)) {
		$respon = $departmentsdata;
        array_push($respons, $respon);
	}

	$result = array(
		'status'=> true,
		'data' => $respons,
		'message' => 'Get data success'
	);
	echo json_encode($result);

} 
elseif (isset($_POST['action']) && $_POST['action'] == 'getRecord') {
	$department_id = $_POST["data"];
	$departmentslistqry = "SELECT * from department where department_status='Enable' AND department_id='$department_id'";
	$departmentslistres = mysqli_query($con, $departmentslistqry);
	$respons = [];
	while ($departmentsdata = mysqli_fetch_assoc($departmentslistres)) {
		$respons = $departmentsdata;
	}

	$result = array(
		'status'=> true,
		'data' => $respons,
		'message' => 'Get data success'
	);
	echo json_encode($result);

} 
elseif (isset($_POST['action']) && $_POST['action'] == 'addRecord') {
	$department_name = $_POST["department_name"];
	if ($department_name != '') {
		$updateqry="INSERT INTO `department`( `department_name`, `department_status`) VALUES ('$department_name','Enable')";
		$updateres=mysqli_query($con,$updateqry);

		http_response_code(200);
		$result = array(
			'status'=> true,
			'message' => 'Add data success'
		);
		echo json_encode($result);
	} else {
		http_response_code(405);
		$result = array(
			'status'=> false,
			'message' => 'Add data fail.'
		);
		echo json_encode($result);
	}
}
elseif (isset($_POST['action']) && $_POST['action'] == 'editRecord') {
	$user_id = $_POST["id"];
	$department_name = $_POST["department_name"];
	if ($user_id != '') {
		$updateqry="UPDATE department SET ";
		$updateqry.="department_name='$department_name' ";
		$updateqry.="WHERE department_id='$user_id'";
		$updateres=mysqli_query($con,$updateqry);

		http_response_code(200);
		$result = array(
			'status'=> true,
			'message' => 'Edit data success'
		);
		echo json_encode($result);
	} else {
		http_response_code(405);
		$result = array(
			'status'=> false,
			'message' => 'Edit data fail.'
		);
		echo json_encode($result);
	}
}
elseif (isset($_POST['action']) && $_POST['action'] == 'deleteRecord') {
	$department_id = $_POST["data"];
	if ($department_id != '') {
		$updateqry="UPDATE department SET department_status='Disable' WHERE department_id='$department_id'";
		$updateres=mysqli_query($con,$updateqry);
		
		http_response_code(200);
		$result = array(
			'status'=> true,
			'message' => 'Delete data success.'
		);
		echo json_encode($result);
	} else {
		http_response_code(405);
		$result = array(
			'status'=> false,
			'message' => 'Delete data fail.'
		);
		echo json_encode($result);
	}
	
}
?>