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
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/r-2.3.0/datatables.min.css"/>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
	<link rel="stylesheet" href="my.css">
</head>

<body class="hold-transition layout-top-nav">
	<div class="wrapper">
		<div class="container-fluid">
			<div class="row pt-3">
				<div class="col-md-12">
					<div class="card card-primary card-outline">
						<div class="card-header">
							<h4 class="card-title">
								<i class="fa fa-sitemap"></i>
								Department Permission
							</h4>
						</div>
						<div class="card-body">
							<div class="form-group">
								<label>Select department</label>
								<select class="form-control select2" name="department_id" id="dept_list">
								</select>
							</div>
						</div>
					</div>
					<div class="card card-primary card-outline">
						<div class="card-header">
							<h4 class="card-title">
								<i class="fa fa-table"></i>
								Detial
							</h4>
						</div>
						<div class="card-body">
							<table class="table table-hover" id="orders" width="100%"></table>
						</div>
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
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/r-2.3.0/datatables.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

	<script>
		$(function() {
			
			$('#dept_list').select2({
				width: '100%',
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

			$('#dept_list').on('select2:select', function(e) {
				const data = e.params.data;
				const action = "getRecord";
				$.ajax({
					type: 'POST',
					url: 'dept_jsontable.php',
					data: {
						action: action,
						formName: data.id
					}
				}).done(function(data) {
					let tableData = []
					console.log(data);
					data.data.forEach(function(data, index) {
						tableData.push([
							`<input name="dept" type="hidden" value="${data.dept}"><input name="menuid" type="hidden" value="${data.menuid}"><input name="submenuid" type="hidden" value="${data.submenuid}">${data.menu}`,
							data.submenu,
							`<input class="toggle-event" data-id="${++index}" type="checkbox" ${data.permission == 'True' ? 'checked' : ''} data-toggle="toggle" data-on="True" data-off="False">`
						])
					})
					initDataTables(tableData)
				}).fail(function() {
					Swal.fire({
						text: 'Can not get data',
						icon: 'error',
						confirmButtonText: 'OK',
					}).then(function() {
						location.assign('dept_permission_1.php')
					})
				})
			});

			function initDataTables(tableData) {
				$('#orders').DataTable({
					destroy: true,
					searching: false,
					ordering:  false,
					info: false,
					paging: false,
					data: tableData,
					columns: [
						{ title: "Menu" , className: "align-middle"},
						{ title: "Sub Menu" , className: "align-middle"},
						{ title: "Permission" , className: "align-middle"}
					],
					initComplete: function() {
						$(document).off('change').on('change', '.toggle-event', function() {
							let param = {}
							param.dept = $(this).closest('tr').find('[name="dept"]').val()
							param.menuid = $(this).closest('tr').find('[name="menuid"]').val()
							param.submenuid = $(this).closest('tr').find('[name="submenuid"]').val()
							param.status = $(this).prop("checked") ? 'True' : 'False'
							console.log(param);
							$.ajax({
								type: 'POST',
								url: 'dept_jsontable.php',
								data: { 
									action: 'updatemenu1',
									data: param 
								}
							}).done(function(resp) {
								window.toastr.remove()
								toastr.success('Data update is complete.')
							}).fail(function(resp) {
								window.toastr.remove()
								toastr.error('Department is null')
							})
						})
					},
					fnDrawCallback: function() {
						$('.toggle-event').bootstrapToggle();
					},
					responsive: {
						details: {
							renderer: $.fn.dataTable.Responsive.renderer.tableAll({
								tableClass: 'table'
							})
						}
					}
				})
			}
			
		});
	</script>

</body>

</html>