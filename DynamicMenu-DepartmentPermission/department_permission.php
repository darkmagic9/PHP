<!DOCTYPE html>
<html>
<?php include 'head.php';?>
<body>
<?php include 'menu.php';?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h4>Department Permission</h4>

			<form method="post" action="department_permission_list.php">
				<div class="form-group">
					<label>Select department</label>
					<select class="form-control" name="department_id" required>
						<option value="">Select Department</option>
						<?php
						include 'database.php';
						$departmentlistqry="SELECT * FROM `department` where department_status='Enable'";
						$departmentlistres=mysqli_query($con,$departmentlistqry);
						while ($departmentdata=mysqli_fetch_assoc($departmentlistres)) {
						?>
						<option value="<?php echo $departmentdata['department_id'];?>"><?php echo $departmentdata['department_name'];?></option>
					<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<input type="submit" name="permission_update" class="btn btn-primary">
				</div>
			</form>
		</div>
	</div>
</div>

<?php include 'footer.php';?>
</body>
</html>