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
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
						<form method="post" action="#">
							<div class="card-body">
								<div class="form-group">
									<label>Select department</label>
									<select class="form-control selectSearch" name="department_id2" id="department_id2"></select>
								</div>
								<div class="form-group">
									<label>Select department</label>
									<select class="form-control" name="department_id" id="department_id">
										<option value="">Select Department</option>
										<?php
										include 'database.php';
										$departmentlistqry = "SELECT * FROM `department` where department_status='Enable'";
										$departmentlistres = mysqli_query($con, $departmentlistqry);
										while ($departmentdata = mysqli_fetch_assoc($departmentlistres)) {
										?>
											<option value="<?php echo $departmentdata['department_id']; ?>"><?php echo $departmentdata['department_name']; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="card-footer">
								<input type="submit" name="permission_update" class="btn btn-primary">
							</div>
						</form>
					</div>
					<div class="card card-primary">
						<div class="card-body">
							<table class="table table-hover" id="recordListing" width="100%"></table>
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
														<input class="toggle-event" name="department_permission[]" type="checkbox" <?php echo ($department_permission == 'True') ? 'checked' : '' ?> value="True" data-toggle="toggle" data-on="True" data-off="False">
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

	<script>
		$(function() {
			
			function initDataTables(tableData) {
				$('#recordListing').DataTable( {
					data: tableData,
					columns: [
						{ title: "Menu" , className: "align-middle"},
						{ title: "Sub Menu" , className: "align-middle"},
						{ title: "Permission", className: "align-middle"}
					],
					initComplete: function () {
						$(document).on('click', '#delete', function(){ 
							let id = $(this).data('id')
							let index = $(this).data('index')
							Swal.fire({
								text: "คุณแน่ใจหรือไม่...ที่จะลบรายการนี้?",
								icon: 'warning',
								showCancelButton: true,
								confirmButtonText: 'ใช่! ลบเลย',
								cancelButtonText: 'ยกเลิก'
							}).then((result) => {
								if (result.isConfirmed) {
									$.ajax({  
										type: "DELETE",  
										url: "../../service/manager/delete.php",  
										data: { 
											id: id
										}
									}).done(function() {
										Swal.fire({
											text: 'รายการของคุณถูกลบเรียบร้อย',
											icon: 'success',
											confirmButtonText: 'ตกลง',
										}).then((result) => {
											location.reload()
										})
									})
								}
							})
						})
					},
					responsive: {
						details: {
							display: $.fn.dataTable.Responsive.display.modal( {
								header: function ( row ) {
									var data = row.data()
									return 'ผู้ใช้งาน: ' + data[1]
								}
							}),
							renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
								tableClass: 'table'
							})
						}
					},
					language: {
						"lengthMenu": "แสดงข้อมูล _MENU_ แถว",
						"zeroRecords": "ไม่พบข้อมูลที่ต้องการ",
						"info": "แสดงหน้า _PAGE_ จาก _PAGES_",
						"infoEmpty": "ไม่พบข้อมูลที่ต้องการ",
						"infoFiltered": "(filtered from _MAX_ total records)",
						"search": 'ค้นหา',
						"paginate": {
							"previous": "ก่อนหน้านี้",
							"next": "หน้าต่อไป"
						}
					}
				})
			}

			$('#department_id2').select2({
				width: '100%',
				placeholder: 'Select Department',
				ajax: {
					url: 'department_permission_crud.php',
					type: "post",
					dataType: 'json',
					delay: 250,
					data: function(params) {
						return {
							searchTerm: params.term // search term
						};
					},
					processResults: function(response) {
						return {
							results: response
						};
					},
					cache: true
				}
			});
			
			$('#department_id2').on('select2:select', function(e) {
				let data = e.params.data;
				let action = "getRecord";
				$.ajax({
					url:"department_permission_db.php",
					method:"POST",
					data:{id:data.id, action:action},
				}).done(function(datas) {
					let tableData = []
					datas.response.forEach(function (item, index){
						tableData.push([
                    		++index,
							item.o_id,
							item.mem_id
						])
					})
					initDataTables(tableData)
				})
			});

			$('#department_id').on('change', function(e) {
				console.log($(this).val());

			});


		});
	</script>
</body>

</html>