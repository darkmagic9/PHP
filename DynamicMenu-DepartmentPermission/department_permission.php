<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>

<body>
	<?php include 'menu.php'; ?>
	<div class="container-fluid">
		<div class="row pt-3">
			<div class="col-md-12">
				<div class="card card-primary">
					<div class="card-header">
						<h4 class="card-title">Department Permission</h4>
					</div>
					<form method="post" action="department_permission_list.php">
						<div class="card-body">
							<div class="form-group">
								<label>Select department</label>
								<select class="form-control" name="department_id" required>
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
							<div class="card-footer">
								<input type="submit" name="permission_update" class="btn btn-primary">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php include 'footer.php'; ?>
</body>

</html>