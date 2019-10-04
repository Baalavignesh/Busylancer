<?php
include("includes/db.php");
session_start();
ob_start();

?>

<?php

  function getIDDynamically($email){
  	  global $connection;
      $query = "SELECT id from `user_account` WHERE `email` = '$email'";
      $result = mysqli_query($connection,$query);
      $row = mysqli_fetch_assoc($result);
      return $row["id"];
  }

?>

<?php

           
               $salt = "happydaytoallofyou123";
               
               $fname = "A";
               $lname = "B";
               $phone = "5445";
               $city = "Cbe";
               $userType = 0;
                
               $email = "sadsa";
               $password = "asdsad";
               $dob = "";
                
               
               
                
               $query = "INSERT INTO `user_account` (`password`, `email`, `first_name`, `last_name`, `dob`) VALUES ('$password','$email','$fname','$lname','$dob')";


               $result = mysqli_query($connection,$query);
               if(!$result){
                   die("Query Failed!");
               }



               $user_account_id = getIDDynamically($email);

               echo($user_account_id);
              
           
            ?>