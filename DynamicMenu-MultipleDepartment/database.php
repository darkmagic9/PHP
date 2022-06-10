<?php
$con=mysqli_connect('localhost','root','','dynamic_menu_multiple_department');

if(mysqli_connect_errno())
{
	echo 'Failed to connect '.mysqli_connect_error();
}
