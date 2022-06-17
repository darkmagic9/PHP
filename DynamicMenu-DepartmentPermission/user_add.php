<?php include 'head.php';?>
<?php include 'menu.php';?>
<?php 
if($user_permission!='False')
{
?>
<h4>User Add</h4>
<?php 
}else
{
    include 'permissiondenied.php';
}
?>
<?php include 'footer.php';?>