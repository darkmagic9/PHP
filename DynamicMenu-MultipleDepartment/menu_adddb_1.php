<?php
header('Content-Type: application/json; charset=utf-8');

include 'database.php';
$respons = [
	'id'=> 1,
	'menu_name'=> 'wwwwwwwwwww',
	'menu_icon'=> 'dddddddddddd',
];

if(isset($_POST['actionAdd']) && $_POST['actionAdd'] == 'addRecord')
{
	$menu_name=$_POST['menu_name'];
	$menu_icon=$_POST['menu_icon'];

	if($menu_name!='')
	{
		$insertqry="INSERT INTO `menu`( `menu_name`, `menu_icon`) VALUES ('$menu_name','$menu_icon')";
		$insertres=mysqli_query($con,$insertqry);
		
		$result = array(
			'status'=> true,
			'message' => 'Add data success'
		);
		echo json_encode($result);
	}
}

elseif (isset($_POST['action']) && $_POST['action'] == 'getRecord') {
	$menu_id = $_POST["data"];
	$menulistqry = "SELECT * from menu where menu_status='Enable' AND menu_id='$menu_id'";
	$menulistres = mysqli_query($con, $menulistqry);
	$respons = [];
	while ($menudata = mysqli_fetch_assoc($menulistres)) {
		$respons = $menudata;
	}

	$result = array(
		'status'=> true,
		'data' => $respons,
		'message' => 'Get data success'
	);
	echo json_encode($result);

} 
elseif (isset($_POST['action']) && $_POST['action'] == 'editRecord') {
	$menu_id = $_POST["id"];
	$menu_name = $_POST["menu_name"];
	$menu_icon = $_POST["menu_icon"];
	if ($menu_id != '') {
		$updateqry="UPDATE menu SET menu_name='$menu_name', menu_icon='$menu_icon' WHERE menu_id='$menu_id'";
		$updateres=mysqli_query($con,$updateqry);

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
	$menu_id = $_POST["data"];
	if ($menu_id != '') {
		$updateqry="UPDATE menu SET menu_status='Disable' WHERE menu_id='$menu_id'";
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