<?php
include "../includes/db.php";
?>


<?php

  function getIDDynamically($email){
      $query = "SELECT id from `user_account` WHERE email = '$email'";
      $result = mysqli_query($connection,$query);
      $row = mysqli_fetch_assoc($result);
      return $row["id"];
  }

?>

<?php
session_start();
ob_start();
           
           if(isset($_POST["submitSignup"])){
                require 'PHPMailerAutoload.php';

                $mail = new PHPMailer;

                $mail->SMTPDebug = 3;                               // Enable verbose debug output

                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'arjunandpableboofromfreelancer@gmail.com';                 // SMTP username
                $mail->Password = 'webdesignpackage';                           // SMTP password
                //$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 25;                                    // TCP port to connect to

                

               
               $hashFormat = "$2y$10$";
               $salt = "iusesomecrazustrings223";
               $hashFormat .= $salt;
               
               
               $fname = $_POST["fname"];
               $lname = $_POST["lname"];
               $phone = $_POST["phone"];
               $city = $_POST["city"];
               if($_POST["userType"] == "Employee"){
                   $userType = 1;
               }
               else{
                   $userType = 0;
               }
                
               $email = mysqli_real_escape_string($connection,$_POST["email"]);
               $password = crypt(mysqli_real_escape_string($connection,$_POST["pass"]),$hashFormat);
               $dob = strtotime($_POST["dob"]);
               $dob = date('Y-m-d H:i:s', $dob);
                
               
               
                
               $query = "INSERT INTO `user_account` (`password`, `email`, `first_name`, `last_name`, `dob`) VALUES ('$password','$email','$fname','$lname','$dob')";
               
               $result = mysqli_query($connection,$query);
               if(!$result){
                   die("Query Failed!");
               }

               $user_account_id = getIDDynamically($email);

               if($userType == 0){
                  $query2 = "INSERT INTO `hire_manager` (`user_account_id`,`location`) VALUES('$user_account_id','$city')";
               }
               
                $mail->setFrom('arjunandpableboofromfreelancer@gmail.com', 'Mailer');
                $mail->addAddress($email, 'Joe User');     // Add a recipient
                $mail->isHTML(true);                                 
                $mail->Subject = 'Confirm your email address with Freelancer';
                $body = "Please click on this link to confirm your email address: <a href=";
               $body .= "http://freelancer.ueuo.com/login.php?email={$email}&confirm={$password}";
               $body .= ">Click here</a>";
                $mail->Body = $body;

                if(!$mail->send()) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    echo 'Message has been sent';
                    header("Location: ../login.php?displayconfirm=1");

                }
               
           }
           
            ?>