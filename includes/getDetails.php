<?php

function getDetails(){
	global $connection;


	$USER_ID = $_SESSION["USER_ID"];

	if($_SESSION["USER_TYPE"] == 0){
		$query = "SELECT * FROM hire_manager natural join user_account WHERE user_account_id = '$USER_ID'";
		$result = mysqli_query($connection,$query);
		$hiring_manager = mysqli_fetch_assoc($result);
		return $hiring_manager;
	}
	else if($_SESSION["USER_TYPE"] == 1){
		$query = "SELECT * FROM freelancer natural join user_account WHERE user_account_id = '$USER_ID'";
		$result = mysqli_query($connection,$query);
		$freelancer = mysqli_fetch_assoc($result);
		
		return $freelancer;
	}
}

?>