<?php

function check_login($con)
{
	//checking whether the session has an user name
	if(isset($_SESSION['user_name']))
	{
		$uname = $_SESSION['user_name'];

		$query = "select * from user where user_name = '$uname' limit 1";

		$result = mysqli_query($con,$query);

		if($result && mysqli_num_rows($result) > 0)
		{
			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}
	//redirect to login
	header("Location: login.php");
	die;

}