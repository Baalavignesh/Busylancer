<?php
include("includes/db.php");
session_start();
ob_start();

if(!isset($_SESSION["USER_ID"])){
    header("Location: index.php");
}

include("includes/getDetails.php");

$freelancer_hirer = getDetails();

?>




<?php


if(isset($_POST["submit"])){
    $expected_duration =  $_POST["expected_duration"];
    $message =  $_POST["message"];
    $message_type = 1;
    
    $pid = $_POST["proposal_id"];
    if($_SESSION["USER_TYPE"] == 0){
        $message_type = 0;
    }

    
    $query = "INSERT INTO message(proposal_id,message_text,message_type) VALUES('$pid','$message','$message_type')";
    $result = mysqli_query($connection,$query);

    header("Location: index.php");
}



?>
