<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Dynamic Menu</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
	<link rel="stylesheet" href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css">
	<link rel="stylesheet" href="my.css">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
	<?php include 'menu.php'; ?>

	<?php
	include 'database.php';
	$user_id = $_POST['user_id'];
	?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h4>User Permission</h4>

				<form method="post" action="user_permission_db.php">
					<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
					<table class="table">
						<thead>
							<tr>
								<th>Menu</th>
								<th>Sub Menu</th>
								<th>Permission</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$menuqry = "SELECT * from sub_menu ";
							$menuqry .= "inner join menu on menu.menu_id=sub_menu.menu_id ";
							$menuqry .= "INNER JOIN submenu_department ON submenu_department.sub_menu_id=sub_menu.submenu_id ";
							$menuqry .= "where submenu_status='Enable' AND submenu_department.department_id='2' ";
							$menuqry .= "ORDER BY menu.menu_id, sub_menu.submenu_id";
							$menures = mysqli_query($con, $menuqry);
							while ($menudata = mysqli_fetch_assoc($menures)) {
							?>
								<input type="hidden" name="menu_id[]" value="<?php echo $menudata['menu_id']; ?>">
								<input type="hidden" name="submenu_id[]" value="<?php echo $submenuid = $menudata['submenu_id']; ?>">
								<tr>
									<td><?php echo $menudata['menu_name']; ?></td>
									<td><?php echo $menudata['submenu_name']; ?></td>
									<td>
										<?php
										$permissionqry = "SELECT user_permission from menu_useraccess where sub_menu_id='$submenuid' AND user_id='$user_id'";
										$permissionres = mysqli_query($con, $permissionqry);
										$permissiondata = mysqli_fetch_assoc($permissionres);
										if ($permissiondata) {
											$user_permission = $permissiondata['user_permission'];
										} else {
											$user_permission = "";
										}
										
										?>
										<select name="user_permission[]" class="form-control">
											<?php
											if ($user_permission) {
											?><option value="<?php echo $user_permission; ?>"><?php echo $user_permission; ?></option>
											<?php
											} ?>
											<option value="False">False</option>
											<option value="True">True</option>
										</select>
									</td>
								</tr>
							<?php
							}
							?>
						</tbody>
					</table>
					<input type="submit" name="permissionsubmit" class="btn btn-primary" value="Update">
				</form>
			</div>
		</div>
	</div>
</div>
<!-- ./wrapper -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<script>
	$('input[type=checkbox]').change ("change",function(){
		var target = $(this).parent().find('input[type=hidden]').val();
		if(target == 'False')
		{
			target = 'True';
		}
		else
		{
			target = 'False';
		}
		$(this).parent().find('input[type=hidden]').val(target);
	});
</script>

</body>
</html>