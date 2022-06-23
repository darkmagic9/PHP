<?php 
header('Content-Type: application/json; charset=utf-8');

include 'database.php';
$respons = [
    [
        'menu'=> 'aaaa',
        'submenu'=> 'aaaa',
    ],
    [
        'menu'=> 'aaaa',
        'submenu'=> 'aaaa',
    ]

];

if (isset($_POST['action']) && $_POST['action'] == 'getRecord') {
    $department_id = $_POST['formName'];
    $menuqry = "SELECT * from sub_menu ";
    $menuqry .= "inner join menu on menu.menu_id=sub_menu.menu_id ";
    $menuqry .= "where submenu_status='Enable' AND submenu_department = '$department_id'";
    $menuqry .= "ORDER BY sub_menu.menu_id, sub_menu.submenu_id";
    $menures = mysqli_query($con, $menuqry);
    $data2 = array();

    while ($menudata = mysqli_fetch_assoc($menures)) {

        $menuid = $menudata['menu_id'];
        $submenuid = $menudata['submenu_id'];
        $permissionqry = "SELECT department_permission from menu_departmentaccess where sub_menu_id='$submenuid' AND department_id='$department_id'";
        $permissionres = mysqli_query($con, $permissionqry);
        $permissiondata = mysqli_fetch_assoc($permissionres);
        if ($permissiondata) {
            $department_permission = $permissiondata['department_permission'];
        } else {
            $department_permission = "False";
        }

        $data = [
            'dept' => $department_id,
            'menuid' => $menudata['menu_id'],
            'menu' => $menudata['menu_name'],
            'submenuid' => $menudata['submenu_id'],
            'submenu' => $menudata['submenu_name'],
            'permission' => $department_permission
        ];    
        array_push($data2, $data);
    }

    $result = array(
        'status'=> true,
        'data' => $data2,
        'message' => 'Get data success'
    );
    echo json_encode($result);

}

if (isset($_POST['action']) && $_POST['action'] == 'updatemenu') {

    $department_id = $_POST['data'][0];
    $menu_id = $_POST['data'][1];
    $submenu_id = $_POST['data'][2];
    $department_permission = $_POST['data'][3];

    if($department_id!='')
	{
		$deleteqry="DELETE FROM menu_departmentaccess where department_id='$department_id' AND menu_id='$menu_id' AND sub_menu_id='$submenu_id'";
		$delteres=mysqli_query($con,$deleteqry);
		
        $insertqry="INSERT INTO `menu_departmentaccess`( `menu_id`, `sub_menu_id`, `department_id`, `department_permission`) VALUES ('$menu_id','$submenu_id','$department_id','$department_permission')";
        $insertres=mysqli_query($con,$insertqry);

        http_response_code(200);
        $result = array(
            'status'=> true,
            'message' => 'Update data success'
        );
        echo json_encode($result);

	} else {
        http_response_code(405);
        $result = array(
            'status'=> false,
            'message' => 'Department is null'
        );
        echo json_encode($result);
    }

    
}

?>