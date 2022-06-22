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

if (isset($_POST['action'])) {
    $department_id = $_POST['formName'];
    $menuqry = "SELECT * from sub_menu ";
    $menuqry .= "inner join menu on menu.menu_id=sub_menu.menu_id ";
    $menuqry .= "where submenu_status='Enable' AND submenu_department = '$department_id'";
    $menuqry .= "ORDER BY sub_menu.menu_id, sub_menu.submenu_id";
    $menures = mysqli_query($con, $menuqry);
    $data2 = array();
    while ($menudata = mysqli_fetch_assoc($menures)) {
        $data = [
            'menu' => $menudata['menu_name'],
            'submenu' => $menudata['submenu_name']
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

?>