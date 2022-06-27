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
	$userslistqry = "SELECT * from users LEFT JOIN department ON users.user_department = department.department_id where users.user_status='Enable'";
	$userslistres = mysqli_query($con, $userslistqry);
	$respon = [];
    $respons = [];
	while ($usersdata = mysqli_fetch_assoc($userslistres)) {
		$respon = $usersdata;
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
	$user_id = $_POST["data"];
	$userslistqry = "SELECT * from users where users.user_status='Enable' AND users.user_id='$user_id'";
	$userslistres = mysqli_query($con, $userslistqry);
	$respons = [];
	while ($usersdata = mysqli_fetch_assoc($userslistres)) {
		$respons = $usersdata;
	}

	$result = array(
		'status'=> true,
		'data' => $respons,
		'message' => 'Get data success'
	);
	echo json_encode($result);

} 
elseif (isset($_POST['action']) && $_POST['action'] == 'addRecord') {
	$user_name = $_POST["user_name"];
	$user_department = $_POST["department_id"];
	if ($user_name != '') {
		$updateqry="INSERT INTO `users`( `user_name`, `user_department`, `user_status`) VALUES ('$user_name','$user_department','Enable')";
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
	$user_name = $_POST["user_name"];
	$user_department = $_POST["department_id"];
	if ($user_id != '') {
		$updateqry="UPDATE users SET ";
		$updateqry.="user_name='$user_name', ";
		$updateqry.="user_department='$user_department' ";
		$updateqry.="WHERE user_id='$user_id'";
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
	$user_id = $_POST["data"];
	if ($user_id != '') {
		$updateqry="UPDATE users SET user_status='Disable' WHERE user_id='$user_id'";
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