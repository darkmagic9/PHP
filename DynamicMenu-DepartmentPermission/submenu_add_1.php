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
	<link rel="stylesheet" href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/r-2.3.0/datatables.min.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
	<link rel="stylesheet" href="my.css">
</head>

<body class="hold-transition layout-top-nav">
	<div class="wrapper">
		<?php include 'menu.php'; ?>
		<div class="container-fluid">
			<div class="row pt-3">
				<div class="col-md-7">
					<div class="card card-primary card-outline">
						<div class="card-header">
							<h4 class="card-title">
								<i class="fas fa-sitemap"></i>
								Sub Menu List
							</h4>
							<div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="submenu_add_1.php" data-source-selector="#card-refresh-content" data-load-on-init="false">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                    <i class="fas fa-expand"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
						</div>
						<div class="card-body">
							<table id="myTable" class="table table-striped">
								<thead>
									<tr>
										<th>S.No</th>
										<th>Menu Name</th>
										<th>Sub Menu Name</th>
										<th>Sub Menu Url</th>
										<th>Sub Menu Order</th>
										<th>Department</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									include 'database.php';
									$menulistqry  = "SELECT sub_menu.*,menu.menu_name,department.department_name from sub_menu ";
									$menulistqry .= "inner join menu on menu.menu_id=sub_menu.menu_id ";
									$menulistqry .= "inner join department on department.department_id=sub_menu.submenu_department ";
									$menulistqry .= "where submenu_status='Enable' ORDER BY department_name, menu.menu_id, submenu_order";
									$menulistres = mysqli_query($con, $menulistqry);
									$i = 1;
									while ($menudata = mysqli_fetch_assoc($menulistres)) {
									?>
										<tr>
											<td><?php echo $i++; ?></td>
											<td><?php echo $menudata['menu_name']; ?></td>
											<td><?php echo $menudata['submenu_name']; ?></td>
											<td><?php echo $menudata['submenu_url']; ?></td>
											<td><?php echo $menudata['submenu_order']; ?></td>
											<td><?php echo $menudata['department_name']; ?></td>
											<td>
											<div class="btn-group" role="group">
												<button type="button" class="btn btn-sm btn-warning text-white update" id="<?php echo $menudata['submenu_id']; ?>" data-id="<?php echo $menudata['submenu_id']; ?>" data-index="<?php echo $menudata['submenu_id']; ?>">
													<i class="fas fa-edit"></i> Edit
												</button>
												<button type="button" class="btn btn-sm btn-danger delete" id="<?php echo $menudata['submenu_id']; ?>" data-id="<?php echo $menudata['submenu_id']; ?>" data-index="<?php echo $menudata['submenu_id']; ?>">
													<i class="fas fa-trash"></i> Delete
												</button>
											</div>
											</td>
										</tr>
									<?php
									}
									?>

								</tbody>
							</table>
						</div>
					</div>
				</div>

				<div class="col-md-5">
					<div class="card card-primary card-outline">
						<div class="card-header">
							<h4 class="card-title">
								<i class="fas fa-table"></i>
								Sub Menu Add
							</h4>
							<div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="submenu_add_1.php" data-source-selector="#card-refresh-content" data-load-on-init="false">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                    <i class="fas fa-expand"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
						</div>
						<div class="card-body">
							<form method="post" action="submenu_adddb_1.php" id="addForm">
								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-3 col-form-label">Menu</label>
									<div class="col-sm-9">
										<select class="form-control" name="menu_id">
											<option value="">Select Menu</option>
											<?php
											$menulistqry = "SELECT * from menu where menu_status='Enable'";
											$menulistres = mysqli_query($con, $menulistqry);
											while ($menudata = mysqli_fetch_assoc($menulistres)) {
											?>
												<option value="<?php echo $menudata['menu_id']; ?>"><?php echo $menudata['menu_name']; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-3 col-form-label">Sub Menu</label>
									<div class="col-sm-9">
										<input type="text" name="submenu_name" placeholder="Sub Menu Name" class="form-control" />
									</div>
								</div>
								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-3 col-form-label">Sub Menu Url</label>
									<div class="col-sm-9">
										<input type="text" name="submenu_url" placeholder="Sub Menu Url" class="form-control" />

									</div>
								</div>
								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-3 col-form-label">Show/Visible</label>
									<div class="col-sm-9">
										<select class="form-control" name="submenu_display">
											<option value="Yes">Yes</option>
											<option value="No">No</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-3 col-form-label">Sub Meno Order</label>
									<div class="col-sm-9">
										<select class="form-control" name="submenu_order">
											<?php
											for ($i = 0; $i < 10; $i++) {
											?>
												<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-3 col-form-label">Department</label>
									<div class="col-sm-9">
										<select class="form-control select2" name="department_id" data-placeholder="Select Department">
											<option value="">Select Department</option>
											<?php
											$deptlistqry = "SELECT * from department where department_status='Enable'";
											$deptlistres = mysqli_query($con, $deptlistqry);
											while ($deptdata = mysqli_fetch_assoc($deptlistres)) {
											?>
												<option value="<?php echo $deptdata['department_id']; ?>"><?php echo $deptdata['department_name']; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
    							<input type="hidden" name="actionAdd" id="actionAdd" value="addRecord" />
								<input name="submenu_submit" class="btn btn-primary" type="submit" value="Add Sub Menu" />
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal" id="editModal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<form method="post" id="editForm">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Modal title</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Menu</label>
							<div class="col-sm-9">
								<select class="form-control" id="menu_id" name="menu_id">
									<option value="">Select Menu</option>
									<?php
									$menulistqry = "SELECT * from menu where menu_status='Enable'";
									$menulistres = mysqli_query($con, $menulistqry);
									while ($menudata = mysqli_fetch_assoc($menulistres)) {
									?>
										<option value="<?php echo $menudata['menu_id']; ?>"><?php echo $menudata['menu_name']; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Sub Menu</label>
							<div class="col-sm-9">
								<input type="text" id="submenu_name" name="submenu_name" placeholder="Sub Menu Name" class="form-control" />
							</div>
						</div>
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Sub Menu Url</label>
							<div class="col-sm-9">
								<input type="text" id="submenu_url" name="submenu_url" placeholder="Sub Menu Url" class="form-control" />

							</div>
						</div>
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Show/Visible</label>
							<div class="col-sm-9">
								<select class="form-control" id="submenu_display" name="submenu_display">
									<option value="Yes">Yes</option>
									<option value="No">No</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Sub Meno Order</label>
							<div class="col-sm-9">
								<select class="form-control" id="submenu_order" name="submenu_order">
									<?php
									for ($i = 0; $i < 10; $i++) {
									?>
										<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Department</label>
							<div class="col-sm-9">
								<select class="form-control" id="department_id" name="department_id">
									<option value="">Select Department</option>
									<?php
									$deptlistqry = "SELECT * from department where department_status='Enable'";
									$deptlistres = mysqli_query($con, $deptlistqry);
									while ($deptdata = mysqli_fetch_assoc($deptlistres)) {
									?>
										<option value="<?php echo $deptdata['department_id']; ?>"><?php echo $deptdata['department_name']; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<div class="modal-footer">
    					<input type="hidden" name="id" id="id" />
    					<input type="hidden" name="action" id="action" value="" />
						<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
    					<input type="submit" class="btn btn-primary" name="save" id="save" value="Save" />
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- ./wrapper -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.18/dist/sweetalert2.all.min.js"></script>
	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/r-2.3.0/datatables.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.full.min.js" integrity="sha512-rNNKEb5WQbxA4pLtGV9W746iT7tZlpjC6duViljPlPQhOOPz6Vu3nae8G9A36/W8WT+BWhso9vgETSfSP604vw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

	<script>
		$(function() {
			//Initialize Select2 Elements
			$('.select2').select2({				
				width: '100%',
			})

			let dataRecords = $('#myTable').DataTable({				
                autoWidth: false,
                responsive: true,
			});

			$('#myTable').on('click', '.update', function() {
				let id = $(this).attr('id');
				console.log(`on update : ${id}`);
				$.ajax({
					type: 'POST',
					url: 'submenu_adddb_1.php',
					data: {
						action: 'getRecord',
						data: id
					}
				}).done(function(resp) {
					console.log(resp);
					$('#editModal').modal('show')
					$('#id').val(resp.data.submenu_id)
					$('#menu_id').val(resp.data.menu_id)
					$('#submenu_name').val(resp.data.submenu_name)
					$('#submenu_url').val(resp.data.submenu_url)
					$('#submenu_display').val(resp.data.submenu_display)
					$('#submenu_order').val(resp.data.submenu_order)
					$('#department_id').val(resp.data.submenu_department)
					$('.modal-title').html('<i class="fas fa-plus"></i> Edit Menu')
					$('#action').val('editRecord')
					$('#save').val('Save changes')
				})
			})

			$('#addForm').submit(function(e) {
				e.preventDefault()
				$.ajax({
					type: 'POST',
					url: $(this).attr('action'),
					data: $(this).serialize()
				}).done(function(resp) {
					$('#addForm')[0].reset();
					window.toastr.remove()
					toastr.success('Data add is complete.')
					setTimeout(() => {
						location.reload()
					}, 800)
				}).fail(function(resp) {
					window.toastr.remove()
					toastr.error('Data add is fail!.')
				})
			})

			$('#editModal').on('submit','#editForm', function(event) {
				event.preventDefault();
				$('#save').attr('disable','disable')
				let formData = $(this).serialize();
				$.ajax({
					type: 'POST',
					url: 'submenu_adddb_1.php',
					data: formData
				}).done(function(resp) {
					$('#editForm')[0].reset();
					$('#editModal').modal('hide');				
					$('#save').attr('disabled', false);
					location.reload()
				})
			})

			$('#myTable').on('click', '.delete', function() {
				let id = $(this).attr('id')
				Swal.fire({
					text: 'Are you sure...to delete this entry?',
					icon: 'warning',
					showCancelButton: true,
					confirmButtonText: 'Yes! Delete now',
					cancelButtonText: 'Cancel'
				}).then((result) => {
					if (result.isConfirmed) {
						$.ajax({
							type: 'POST',
							url: 'submenu_adddb_1.php',
							data: {
								action: 'deleteRecord',
								data: id
							}
						}).done(function() {
							Swal.fire({
								title: 'Deleted!',
								text: 'Your list has been deleted.',
								icon: 'success',
								confirmButtunText: 'OK'
							}).then((result) => {
								location.reload()
							})
						})
					}
				})

			})
		})
	</script>

</body>

</html>