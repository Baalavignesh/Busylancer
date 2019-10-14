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

           if(isset($_POST["next"])){
               $salt = "happydaytoallofyou123";
               
               $fname = $_POST["fname"];
               $lname = $_POST["lname"];
               $location = $_POST["location"];
               if($_POST["userType"] == "Employee"){
                   $userType = 1;
               }
               else{
                   $userType = 0;
               }
                
               $email = mysqli_real_escape_string($connection,$_POST["email"]);
               echo mysqli_real_escape_string($connection,$_POST["password"].$salt);
               $password = md5(mysqli_real_escape_string($connection,$_POST["password"].$salt));
               echo $password;
               $dob = strtotime($_POST["dob"]);
               $dob = date('Y-m-d H:i:s', $dob);
                
               
               
                
               $query = "INSERT INTO `user_account` (`password`, `email`, `first_name`, `last_name`, `dob`) VALUES ('$password','$email','$fname','$lname','$dob')";
               $result = mysqli_query($connection,$query);
               if(!$result){
                   die("Query Failed!");
               }

               $user_account_id = getIDDynamically($email);

               if($userType == 0){
                  $query2 = "INSERT INTO `hire_manager` (`user_account_id`,`location`) VALUES('$user_account_id','$location')";
               }
               else{
                  $query2 = "INSERT INTO `freelancer` (`user_account_id`,`location`) VALUES('$user_account_id','$location')";
               }

               $result = mysqli_query($connection,$query2);

               if(!$result){
               	die("Insert into rel table Failed");
               }

               //header("Location: login.php?displayconfirm=1");
               
           }
           
            ?>