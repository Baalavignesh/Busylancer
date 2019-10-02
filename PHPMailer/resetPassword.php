<?php
include "../includes/db.php";
session_start();
ob_start();

?>
         

          
          
          <?php
           
           if(isset($_POST["submit"])){
                require 'PHPMailerAutoload.php';

               
                $emailID = mysqli_real_escape_string($connection,$_POST["email"]);

                $query = "SELECT * FROM users WHERE email='$emailID'";
                $result = mysqli_query($connection,$query);

                $row = mysqli_fetch_assoc($result);
                $hashedPass = $row["password"]; //we get only 32 characters here
                $id = $row["user_id"];

                $mail = new PHPMailer;

                $mail->SMTPDebug = 3;                               // Enable verbose debug output

                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'arjunandpableboofromfreelancer@gmail.com';                 // SMTP username
                $mail->Password = 'webdesignpackage';                           // SMTP password
                //$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 25;                                    // TCP port to connect to

                $mail->setFrom('arjunandpableboofromfreelancer@gmail.com', 'Mailer');
                $mail->addAddress($emailID, 'Joe User');     // Add a recipient
                $mail->isHTML(true);                                 
                $mail->Subject = 'Reset your password with Freelancer';
                $body = "Please click on this link to reset your password: <a href=";
               $body .= "http://freelancer.ueuo.com/PHPMailer/resetPassword.php?id={$id}&password={$hashedPass}";
               $body .= ">Click here</a>";
                $mail->Body = $body;

                if(!$mail->send()) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    echo 'Message has been sent';
                    header("Location: ../login.php?passwordResetMailSent=1");

                }
               
           }
           
            ?>
            
           
<?php

if(isset($_GET["id"])){
    $id = $_GET["id"];
    $password = $_GET["password"];
    
    $query = "SELECT * FROM users WHERE user_id='$id'";
    $result = mysqli_query($connection,$query);
    
    $row = mysqli_fetch_assoc($result);
    
    $user_password = $row["password"];
    
    if($user_password != $password){
        echo $user_password;
        echo "<br>";
        echo $password;
    }
    else{
    $_SESSION["temporaryIDForForgotPassword"] = $id;
    ?> 





<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/login.css">
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js"></script>
        
        <script>
            function validatePass(){
                var statusElement = document.getElementById("passwordStatus");
                var password = document.getElementById("password").value;
                
                var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
                if(password.match(passw)){
                    statusElement.innerHTML = "Awesome !<br>";
                    isEverythingValid[1] = 1;
                }
                else{
                    statusElement.innerHTML = "Password must be 6 to 20 characters long, must contain one uppercase, one lowercase letter and one number!<br>";
                    isEverythingValid[1] = 0;
                }
                
                
            }
            
            function validateCPass(){
                var statusElement = document.getElementById("cpasswordStatus");
                var password = document.getElementById("cpassword").value;
                var actualpass = document.getElementById("password").value;
                if(password == actualpass && password != ""){
                    statusElement.innerHTML = "Awesome !<br>";
                    isEverythingValid[2] = 1;
                }
                else{
                    statusElement.innerHTML = "Passwords don't match !";
                    isEverythingValid[2] = 0;
                }
                
                
            }
            
        </script>
    </head>
    <body>
       <form name="loginForm" id="msform" action="../forgotPassword.php" method="post">

         
          <!-- progressbar -->
          <ul id="progressbar">
            <li class="active">Reset Password</li>
          </ul>
          <!-- fieldsets -->
          <fieldset>
            <h2 class="fs-title">Enter your new password</h2><br><br>
            <input name="password" onkeyup="validatePass();" id="password" type="password" name="pass" placeholder="Password"/>
            <span class="fs-subtitle" style="color:red" id="passwordStatus"></span>

            <input name="cpassword" id="cpassword" onkeyup="validateCPass();" type="password" name="cpass" placeholder="Confirm Password" />
            <span class="fs-subtitle" style="color:red" id="cpasswordStatus"></span><br>

 
            <input type="submit" required name="submitNewPassword" class="next action-button" value="Submit" />
            <br>
            
          </fieldset>
            
        </form>
        
    </body>
</html>


<?php
    }   
}

?>