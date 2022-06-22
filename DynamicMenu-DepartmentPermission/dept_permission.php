<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Dynamic Menu</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
	<link rel="stylesheet" href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css"/>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
	<link rel="stylesheet" href="my.css">
</head>

<body class="hold-transition layout-top-nav">
	<div class="wrapper">
		<?php include 'menu.php'; ?>
		<?php
		if (isset($_POST['department_id'])) {
			$department_id = $_POST['department_id'];
		}
		?>
		<div class="container-fluid">
			<div class="row pt-3">
				<div class="col-md-12">
					<div class="card card-primary">
						<div class="card-header">
							<h4 class="card-title">Department Permission</h4>
						</div>
						<div class="card-body">
							<div class="form-group">
								<label>Select department</label>
								<select class="form-control select2" name="department_id" id="dept_list">
								</select>
							</div>
						</div>
					</div>
					<div class="card card-primary">
						<div class="card-body">
							<table class="table" id="orders">
								<thead>
									<tr>
										<th>Menu</th>
										<th>Sub Menu</th>
										<th>Permission</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
					<div class="card card-primary">
						<?php if (isset($department_id)) { ?>
							<form method="post" action="department_permission_db.php">
								<div class="card-body">
									<input type="hidden" name="department_id" value="<?php echo $department_id; ?>">
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
											$menuqry .= "where submenu_status='Enable' AND submenu_department = '$department_id'";
											$menuqry .= "ORDER BY sub_menu.menu_id, sub_menu.submenu_id";
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
														$permissionqry = "SELECT department_permission from menu_departmentaccess where sub_menu_id='$submenuid' AND department_id='$department_id'";
														$permissionres = mysqli_query($con, $permissionqry);
														$permissiondata = mysqli_fetch_assoc($permissionres);
														if ($permissiondata) {
															$department_permission = $permissiondata['department_permission'];
														} else {
															$department_permission = "";
														}

														?>
														<input name="department_permission[]" type="hidden" value="False">
														<input type="checkbox" <?php echo ($department_permission == 'True') ? 'checked' : '' ?> data-toggle="toggle" data-on="True" data-off="False">
													</td>
												</tr>
											<?php
											}
											?>
										</tbody>
									</table>
								</div>
								<div class="card-footer">
									<input type="submit" name="permissionsubmit" class="btn btn-primary" value="Update">
								</div>
							</form>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- ./wrapper -->
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

	<script>
		$(function() {

			$('#dept_list').select2({
				placeholder: 'Select Department',
				ajax: {
					url: 'dept_json.php',
					delay: 250, // wait 250 milliseconds before triggering the request
					data: function(params) {
						return {
							searchTerm: params.term // search term
						};
					},
					processResults: function(response) {
						return {
							results: response.data
							// results: $.map(response, function(item) {
							// 	return {
							// 		text: item.language,
							// 		id: item.id
							// 	}
							// })
						};
					},
					cache: true
				}
			});

			// Disable search and ordering by default
			$.extend( $.fn.dataTable.defaults, {
				searching: false,
				ordering:  false
			} );

			$('#dept_list').on('select2:select', function(e) {
				const data = e.params.data;
				console.log(data.id);
				var filtertables = $('#orders').DataTable( {
					destroy: true,
					ordering: true,
					info: false,
					paging: false,
					ajax: {
						type: 'POST',
						url: 'dept_jsontable.php',
						'data': {
						formName: data.id,
						action: 'search'
						}
					},
					columns: [
						{ data: 'menu' },
						{ data: 'submenu' },
						{ defaultContent: '<input type="checkbox" data-toggle="toggle" data-on="True" data-off="False">' }
					],

				});
			});
			
		});
	</script>

</body>

</html>