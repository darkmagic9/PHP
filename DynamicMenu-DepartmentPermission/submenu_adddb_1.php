<?php
header('Content-Type: application/json; charset=utf-8');

include 'database.php';
$respons = [
	'id'=> 1,
	'submenu_name'=> 'wwwwwwwwwww',
	'submenu_icon'=> 'dddddddddddd',
];

if (isset($_POST['action']) && $_POST['action'] == 'getRecord') {
	$subsubmenu_id = $_POST["data"];
	$submenulistqry = "SELECT * from sub_menu where sub_menu.submenu_status='Enable' AND sub_menu.submenu_id='$subsubmenu_id'";
	$submenulistres = mysqli_query($con, $submenulistqry);
	$respons = [];
	while ($submenudata = mysqli_fetch_assoc($submenulistres)) {
		$respons = $submenudata;
	}

	$result = array(
		'status'=> true,
		'data' => $respons,
		'message' => 'Get data success'
	);
	echo json_encode($result);

} 
elseif (isset($_POST['action']) && $_POST['action'] == 'editRecord') {
	$submenu_id = $_POST["id"];
	$menu_id = $_POST["menu_id"];
	$submenu_name = $_POST["submenu_name"];
	$submenu_url = $_POST["submenu_url"];
	$submenu_display = $_POST["submenu_display"];
	$submenu_order = $_POST["submenu_order"];
	$department_id = $_POST["department_id"];
	if ($submenu_id != '') {
		$updateqry="UPDATE sub_menu SET ";
		$updateqry.="menu_id='$menu_id', ";
		$updateqry.="submenu_name='$submenu_name', ";
		$updateqry.="submenu_url='$submenu_url', ";
		$updateqry.="submenu_display='$submenu_display', ";
		$updateqry.="submenu_order='$submenu_order', ";
		$updateqry.="submenu_department='$department_id' ";
		$updateqry.="WHERE submenu_id='$submenu_id'";
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
	$submenu_id = $_POST["data"];
	if ($submenu_id != '') {
		$updateqry="UPDATE sub_menu SET submenu_status='Disable' WHERE submenu_id='$submenu_id'";
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