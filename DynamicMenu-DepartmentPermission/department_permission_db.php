<?php
include 'database.php';

if(isset($_POST['permissionsubmit']))
{
$department_id=$_POST['department_id'];
	if($department_id!='')
	{
		$deleteqry="DELETE FROM menu_departmentaccess where department_id='$department_id'";
		$delteres=mysqli_query($con,$deleteqry);
		
		foreach ($_POST['department_permission'] as $key => $value) {
			$department_permission=$_POST['department_permission'][$key];
			$menu_id=$_POST['menu_id'][$key];
			$submenu_id=$_POST['submenu_id'][$key];

			$insertqry="INSERT INTO `menu_departmentaccess`( `menu_id`, `sub_menu_id`, `department_id`, `department_permission`) VALUES ('$menu_id','$submenu_id','$department_id','$department_permission')";
			$insertres=mysqli_query($con,$insertqry);
		}
	}
}
echo '<script>alert(" Permission is added successfully.");
		window.location="index.php";
</script>';
?>