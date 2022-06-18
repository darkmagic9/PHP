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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
	<link rel="stylesheet" href="my.css">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

	<?php include 'menu.php'; ?>
	<div class="container-fluid">
		<div class="row pt-3">
			<div class="col-md-6">
				<div class="card card-primary card-outline">
					<div class="card-header">
						<h4 class="card-title">Menu List</h4>
					</div>
					<div class="card-body table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>S.No</th>
									<th>Menu Name</th>
									<th>Menu Icon</th>
								</tr>
							</thead>
							<tbody>
								<?php
								include 'database.php';
								$menulistqry = "SELECT * from menu where menu_status='Enable'";
								$menulistres = mysqli_query($con, $menulistqry);
								while ($menudata = mysqli_fetch_assoc($menulistres)) {
								?>
									<tr>
										<td><?php echo $menudata['menu_id']; ?></td>
										<td><?php echo $menudata['menu_name']; ?></td>
										<td><?php echo $menudata['menu_icon']; ?></td>
									</tr>
								<?php
								}
								?>

							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="card card-primary">
					<div class="card-header">
						<h4 class="card-title">Menu Add</h4>
					</div>
					<form method="post" action="menu_adddb.php">
						<div class="card-body">
							<div class="form-group row">
								<label for="inputMenuName" class="col-sm-3 col-form-label">Menu Name</label>
								<div class="col-sm-9">
									<input type="text" name="menu_name" placeholder="Menu Name" class="form-control" />
								</div>
							</div>
							<div class="form-group row">
								<label for="inputMenuIcon" class="col-sm-3 col-form-label">Menu Icon</label>
								<div class="col-sm-9">
									<input type="text" name="menu_icon" placeholder="Menu Icon" class="form-control" />
								</div>
							</div>
						</div>					
						<div class="card-footer">
							<input name="menu_submit" class="btn btn-primary" type="submit" value="Add Menu" />
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ./wrapper -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

</body>
</html>