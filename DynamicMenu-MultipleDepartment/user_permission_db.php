<?php
include 'database.php';

if(isset($_POST['permissionsubmit']))
{
$user_id=$_POST['user_id'];
	if($user_id!='')
	{
		$deleteqry="DELETE FROM menu_useraccess where user_id='$user_id'";
		$delteres=mysqli_query($con,$deleteqry);
		
		foreach ($_POST['user_permission'] as $key => $value) {
			$user_permission=$_POST['user_permission'][$key];
			$menu_id=$_POST['menu_id'][$key];
			$submenu_id=$_POST['submenu_id'][$key];

			$insertqry="INSERT INTO `menu_useraccess`( `menu_id`, `sub_menu_id`, `user_id`, `user_permission`) VALUES ('$menu_id','$submenu_id','$user_id','$user_permission')";
			$insertres=mysqli_query($con,$insertqry);
		}
	}
echo '<script>alert(" Permission is added successfully.");
		window.location="index.php";
</script>';

}


if(!empty($_POST['action']) && $_POST['action'] == 'getRecord') {
	// $department_id = $_POST["id"];
	// $menuqry = "SELECT * from sub_menu ";
	// $menuqry .= "inner join menu on menu.menu_id=sub_menu.menu_id ";
	// $menuqry .= "where submenu_status='Enable' AND submenu_department = '$department_id'";
	// $menuqry .= "ORDER BY sub_menu.menu_id, sub_menu.submenu_id";
	// $menures = mysqli_query($con, $menuqry);
	// $result = array();
	// while ($menudata = mysqli_fetch_array($menures, MYSQLI_ASSOC)) {
	// 	array_push($result,$menudata);
	// }
		
	// $output = array(
	// 	'status' => true,
	// 	'response'	=> $result,
	// 	'message' => 'Get Data Success'
	// );
    // http_response_code(200);
	// echo json_encode($output);
	

	$response = [
	    'status' => true,
	    'response' => array([
	            'o_id' => 'PO00001',
	            'mem_id' => '1',
	            'mem_name' => 'Yothin Sapsamran',
	            'total' => '7,000.00',
	            'ps' => 'หมายเหตุอื่นๆ....',
	            'status' => '0',
	            'updated_at' => '2020-10-01 20:50:40',
	            'created_at' => '2020-10-01 20:50:40'
	        ],[
	            'o_id' => 'PO00002',
	            'mem_id' => '2',
	            'mem_name' => 'Yothin Sapsamran',
	            'total' => '2,600.00',
	            'ps' => 'หมายเหตุอื่นๆ....',
	            'status' => '0',
	            'updated_at' => '2020-10-01 20:50:40',
	            'created_at' => '2020-10-01 20:50:40'
	        ],[
	            'o_id' => 'PO00003',
	            'mem_id' => '3',
	            'mem_name' => 'Yothin Sapsamran',
	            'total' => '3,500.00',
	            'ps' => 'หมายเหตุอื่นๆ....',
	            'status' => '1',
	            'updated_at' => '2020-10-01 20:50:40',
	            'created_at' => '2020-10-01 20:50:40'
	        ],[
	            'o_id' => 'PO00004',
	            'mem_id' => '4',
	            'mem_name' => 'Yothin Sapsamran',
	            'total' => '4,000.00',
	            'ps' => 'หมายเหตุอื่นๆ....',
	            'status' => 'true',
	            'updated_at' => '2020-10-01 20:50:40',
	            'created_at' => '2020-10-01 20:50:40'
	        ]
	    ),
	    'message' => 'Get Data Success'
	];
	http_response_code(200);
	echo json_encode($response);
}
	

?>