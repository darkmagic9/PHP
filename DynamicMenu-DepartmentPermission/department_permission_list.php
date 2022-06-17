<?php include 'head.php'; ?>
<?php include 'menu.php'; ?>

<?php
include 'database.php';
$department_id = $_POST['department_id'];
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h4>Department Permission</h4>

			<form method="post" action="department_permission_db.php">
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
									<select name="department_permission[]" class="form-control">
										<?php
										if ($department_permission) {
										?><option value="<?php echo $department_permission; ?>"><?php echo $department_permission; ?></option>
										<?php
										} ?>
										<option value="False">False</option>
										<option value="True">True</option>
									</select>
								</td>
							</tr>
						<?php
						}
						?>
					</tbody>
				</table>
				<input type="submit" name="permissionsubmit" class="btn btn-primary" value="Update">
			</form>
		</div>
	</div>
</div>
<?php include 'footer.php'; ?>