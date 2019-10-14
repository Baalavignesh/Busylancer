<?php

function getDetails(){
	global $connection;


	$user_id = $_SESSION["USER_ID"];
	$query = "SELECT * FROM user_account WHERE id = '$user_id'";
	$result = mysqli_query($connection,$query);
	$user_account = mysqli_fetch_assoc($result);


	if($_SESSION["USER_TYPE"] == 0){
		$hid = $_SESSION["HIRING_MANAGER_ID"];
		$query = "SELECT * FROM hire_manager WHERE id = '$hid'";
		$result = mysqli_query($connection,$query);
		$hiring_manager = mysqli_fetch_assoc($result);
		return array($user_account,$hiring_manager);
	}
	else if($_SESSION["USER_TYPE"] == 1){
		$fid = $_SESSION["FREELANCER_ID"];
		$query = "SELECT * FROM freelancer WHERE id = '$fid'";
		$result = mysqli_query($connection,$query);
		$freelancer = mysqli_fetch_assoc($result);
		return array($user_account,$freelancer);
	}
}

?>