<?php

include("includes/db.php");
session_start();
ob_start();
  
?>

<?php

if(isset($_POST["submitNewPassword"])){
                $hashFormat = "$2y$10$";
                $salt = "iusesomecrazustrings223";
                $hashFormat .= $salt;
               
               
                $password = crypt(mysqli_real_escape_string($connection,$_POST["password"]),$hashFormat);
    
                $user_id = $_SESSION["temporaryIDForForgotPassword"];
                unset($_SESSION["temporaryIDForForgotPassword"]);
    
                $query = "UPDATE users SET password='$password' WHERE user_id='$user_id'";
                $result = mysqli_query($connection,$query);
                if(!$result){
                    die("Cannot update password!");
                }
    
                header("Location: login.php");
}

?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js"></script>
    </head>
    <body>
       <form name="loginForm" id="msform" action="PHPMailer/resetPassword.php" method="post">

         
          <!-- progressbar -->
          <ul id="progressbar">
            <li class="active">Forgot Password</li>
          </ul>
          <!-- fieldsets -->
          <fieldset>
            <h2 class="fs-title">Enter your email ID</h2><br><br>
            <input type="text" name="email" required placeholder="Email ID" />
            <input type="submit" required name="submit" class="next action-button" value="Submit" />
            <br>
            
            <br>
            <h5 class = "white"> New here? <a href = "signUpForm.php">  Create an account</a> </h5>
            
          </fieldset>
            
        </form>
    </body>
</html>
