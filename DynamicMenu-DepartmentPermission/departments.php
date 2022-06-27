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
        <?php 
        if($user_permission!='False') {        
        ?>
		<div class="container-fluid">
			<div class="row pt-3">
				<div class="col-12">
					<div class="card card-primary card-outline">
						<div class="card-header">
							<h4 class="card-title">
								<i class="fas fa-sitemap"></i>
								Departments List
							</h4>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="departments.php" data-source-selector="#card-refresh-content" data-load-on-init="false">
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
                            <button type="button" name="add" id="addRecord" class="btn btn-primary mb-3">
                                <i class="fas fa-plus"></i>
                                Add Data
                            </button>
							<table id="myTable" class="table table-striped"></table>
						</div>
					</div>
				</div>
			</div>
		</div>
        <?php 
        } else {
            include 'permissiondenied.php';
        }
        ?>
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
							<label for="inputEmail3" class="col-sm-3 col-form-label">Department</label>
							<div class="col-sm-9">
								<input type="text" id="department_name" name="department_name" placeholder="Department Name" class="form-control" required />
							</div>
						</div>
					</div>
					<div class="modal-footer">
    					<input type="hidden" name="id" id="id" />
    					<input type="hidden" name="action" id="action" value="" />
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
            let dataRecords = $('#myTable').DataTable({
                autoWidth: false,
                responsive: true,
                ajax: {
                    type: 'POST',
                    url: 'departmentsdb.php',
                    data: {action: 'listRecords'},
                    error: function (xhr, error, thrown) {
                        toastr.error('The combination of name and company has to be unique')  
                    }
                },
                columns: [
                    {
                        title: 'No', 
                        className: 'align-middle',
                        data: null, render: function (data, type, full, meta) {
							return meta.row + 1
						}
                    },
                    {
                        title: "Department", 
                        className: "align-middle",
                        data: 'department_name'
                    },
                    {
                        title: "Action", 
                        className: "align-middle",
                        data: null, render: function(data, type, row) {
                            return `<button type="button" class="btn btn-sm btn-warning text-white update" id="${data.department_id}" data-id="${data.department_id}" data-index="${data.department_id}">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger delete" id="${data.department_id}" data-id="${data.department_id}" data-index="${data.department_id}">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>`
                        }
                    },
                ],
                responsive: {
                    details: {
                        renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                            tableClass: 'table'
                        })
                    }
                }
            })

            $('#addRecord').click(function(){
                $('#editModal').modal('show');
                $('#editForm')[0].reset();
                $('.modal-title').html("<i class='fa fa-plus'></i> Add User");
                $('#action').val('addRecord');
                $('#save').val('Add');
            })

            $('#myTable').on('click', '.update', function() {
				let id = $(this).attr('id');
				console.log(`on update : ${id}`);
				$.ajax({
					type: 'POST',
					url: 'departmentsdb.php',
					data: {
						action: 'getRecord',
						data: id
					}
				}).done(function(resp) {
					console.log(resp);
					$('#editModal').modal('show')
					$('#id').val(resp.data.department_id)
					$('#department_name').val(resp.data.department_name)
					$('.modal-title').html('<i class="fas fa-plus"></i> Edit User')
					$('#action').val('editRecord')
					$('#save').val('Save changes')
				})
			})

            $('#editModal').on('submit','#editForm', function(event) {
				event.preventDefault();
				$('#save').attr('disable','disable')
				let formData = $(this).serialize();
				$.ajax({
					type: 'POST',
					url: 'departmentsdb.php',
					data: formData
				}).done(function(resp) {
					$('#editForm')[0].reset();
					$('#editModal').modal('hide');				
					$('#save').attr('disabled', false);
					dataRecords.ajax.reload()
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
							url: 'departmentsdb.php',
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
								dataRecords.ajax.reload()
							})
						})
					}
				})

			})
        })
    </script>

</body>

</html>