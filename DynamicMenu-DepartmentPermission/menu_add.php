<?php include 'head.php'; ?>
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
						<div class="card-footer">
							<input name="menu_submit" class="btn btn-primary" type="submit" value="Add Menu" />
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php'; ?>