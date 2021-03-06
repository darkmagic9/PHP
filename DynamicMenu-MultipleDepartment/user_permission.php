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
						<h4 class="card-title">User Permission</h4>
					</div>
					<form method="post" action="user_permission_list.php">
						<div class="card-body">
							<div class="form-group">
								<label>Select User</label>
								<select class="form-control" name="user_id" required>
									<option value="">Select User</option>
									<?php
									include 'database.php';
									$userlistqry = "SELECT * from users where user_status='Enable'";
									$userlistres = mysqli_query($con, $userlistqry);
									while ($userdata = mysqli_fetch_assoc($userlistres)) {
									?>
										<option value="<?php echo $userdata['user_id']; ?>"><?php echo $userdata['user_name']; ?></option>
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