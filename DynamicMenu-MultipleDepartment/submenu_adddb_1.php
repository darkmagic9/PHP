<?php
header('Content-Type: application/json; charset=utf-8');

include 'database.php';
$respons = [
	'id'=> 1,
	'submenu_name'=> 'wwwwwwwwwww',
	'submenu_icon'=> 'dddddddddddd',
];

if(isset($_POST['actionAdd']) && $_POST['actionAdd'] == 'addRecord')
{
	$menu_id=$_POST['menu_id'];
	$submenu_name=$_POST['submenu_name'];
	$submenu_url=$_POST['submenu_url'];
	$submenu_display=$_POST['submenu_display'];
	$submenu_order=$_POST['submenu_order'];
	$department_id=$_POST['department_id'];

	if($submenu_name!='')
	{
		$insertqry="INSERT INTO `sub_menu`( `menu_id`, `submenu_name`, `submenu_url`, `submenu_display`, `submenu_order`) VALUES ('$menu_id','$submenu_name','$submenu_url','$submenu_display','$submenu_order')";
		$insertres=mysqli_query($con,$insertqry);

		$lastid=$con->insert_id;
	
		foreach ($_POST['department_id'] as $key => $value) {
			$department_id=$_POST['department_id'][$key];

			$subdeptqry="INSERT INTO `submenu_department`( `menu_id`, `sub_menu_id`, `department_id`) VALUES ('$menu_id','$lastid','$department_id')";
			$subdeptres=mysqli_query($con,$subdeptqry);
		}

		$result = array(
			'status'=> true,
			'message' => 'Add data success'
		);
		echo json_encode($result);
	}
}

elseif (isset($_POST['action']) && $_POST['action'] == 'getRecord') {
	$submenu_id = $_POST["data"];
	$submenulistqry = "SELECT * from sub_menu where sub_menu.submenu_status='Enable' AND sub_menu.submenu_id='$submenu_id'";
	$submenulistres = mysqli_query($con, $submenulistqry);
	$respons = [];
	while ($submenudata = mysqli_fetch_assoc($submenulistres)) {
		$submenu_id = $submenudata['submenu_id'];
		$deptlistqry = "SELECT * from submenu_department where submenu_department.status='Enable' AND submenu_department.sub_menu_id='$submenu_id'";
		$deptlistres = mysqli_query($con, $deptlistqry);
		$deptid = [];
		while ($deptdata = mysqli_fetch_assoc($deptlistres)) {
			array_push($deptid, $deptdata['department_id']);
		}
		$respons = [
			'menu_id' => $submenudata['menu_id'],
			'submenu_department' => $deptid,
			'submenu_display' => $submenudata['submenu_display'],
			'submenu_id' => $submenudata['submenu_id'],
			'submenu_name' => $submenudata['submenu_name'],
			'submenu_order' => $submenudata['submenu_order'],
			'submenu_status' => $submenudata['submenu_status'],
			'submenu_url' => $submenudata['submenu_url']
		];
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
	if ($submenu_id != '') {
		$updateqry="UPDATE sub_menu SET ";
		$updateqry.="menu_id='$menu_id', ";
		$updateqry.="submenu_name='$submenu_name', ";
		$updateqry.="submenu_url='$submenu_url', ";
		$updateqry.="submenu_display='$submenu_display', ";
		$updateqry.="submenu_order='$submenu_order' ";
		$updateqry.="WHERE submenu_id='$submenu_id'";
		$updateres=mysqli_query($con,$updateqry);

		$deleteqry="DELETE FROM `submenu_department` WHERE `submenu_department`.`sub_menu_id` ='$submenu_id'";
		$deleteres=mysqli_query($con,$deleteqry);

		foreach ($_POST['department_id'] as $key => $value) {
			$department_id=$_POST['department_id'][$key];

			$subdeptqry="INSERT INTO `submenu_department`( `menu_id`, `sub_menu_id`, `department_id`) VALUES ('$menu_id','$submenu_id','$department_id')";
			$subdeptres=mysqli_query($con,$subdeptqry);
		}

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
		$submenudeleteqry="DELETE FROM `sub_menu` WHERE `sub_menu`.`submenu_id` ='$submenu_id'";
		$submenudeleteres=mysqli_query($con,$submenudeleteqry);
		
		$submenudeptdeleteqry="DELETE FROM `submenu_department` WHERE `submenu_department`.`sub_menu_id` ='$submenu_id'";
		$submenudeptdeleteres=mysqli_query($con,$submenudeptdeleteqry);
		
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