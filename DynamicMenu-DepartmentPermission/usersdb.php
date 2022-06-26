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
elseif (isset($_POST['action']) && $_POST['action'] == 'editRecord') {
	$users_id = $_POST["id"];
	$menu_id = $_POST["menu_id"];
	$users_name = $_POST["users_name"];
	$users_url = $_POST["users_url"];
	$users_display = $_POST["users_display"];
	$users_order = $_POST["users_order"];
	$department_id = $_POST["department_id"];
	if ($users_id != '') {
		$updateqry="UPDATE sub_menu SET ";
		$updateqry.="menu_id='$menu_id', ";
		$updateqry.="users_name='$users_name', ";
		$updateqry.="users_url='$users_url', ";
		$updateqry.="users_display='$users_display', ";
		$updateqry.="users_order='$users_order', ";
		$updateqry.="users_department='$department_id' ";
		$updateqry.="WHERE users_id='$users_id'";
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
			'status'=> true,
			'message' => 'Edit data fail.'
		);
		echo json_encode($result);
	}
}
elseif (isset($_POST['action']) && $_POST['action'] == 'deleteRecord') {
	$users_id = $_POST["data"];
	if ($users_id != '') {
		$updateqry="UPDATE sub_menu SET users_status='Disable' WHERE users_id='$users_id'";
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
			'status'=> true,
			'message' => 'Delete data fail.'
		);
		echo json_encode($result);
	}
	
}
?>