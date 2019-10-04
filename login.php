<?php

include("includes/db.php");
session_start();
ob_start();

if(isset($_SESSION["user_id"]) && $_SESSION["user_id"] != -2){
    header("Location: index.php");
}

    
?>

<?php


if(isset($_GET["email"])){
    $email = $_GET["email"];
    $hashedpass = $_GET["confirm"];
    
    //query
    
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($connection,$query);
    
    while($row = mysqli_fetch_assoc($result)){
        $id = $row["user_id"];
        $pass = $row["password"];
        if($pass == substr($hashedpass,0,32)){
            $query1 = "UPDATE users SET active='1' WHERE user_id='$id' ";
            $result1 = mysqli_query($connection,$query1);
            header("Location: login.php");

            if(!$result1){
                die("Cannot make user active : update query failed !");

            }
            echo "Done !" . $id . $pass;
            
        }
    }
}

?>

   
   
   <html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js"></script>
        
        
        <script>
    
            function validateForm(){
                
                var userName = document.forms['loginForm']['username'].value;
                if(userName.length < 5){
                    alert("Username should be atleast 5 characters long !");
                    return false;
                }
                else{
                    return true;
                }
                
                
            }
        </script>
    </head>
    <body>
      
       <form name="loginForm" id="msform" onsubmit="return validateForm();" action="login.php" method="post">
         
         
         <?php
            if(isset($_GET["displayconfirm"])){
                $value = $_GET["displayconfirm"];
                
                if($value == 1){
                    ?>
                    
                    <h2 class="fs-title">Sign-up successful! Please login!</h2><br>

                    
                    
                    <?php
                }
            }
           
           ?>
           
           <?php
           
            if(isset($_GET["passwordResetMailSent"])){
                $value = $_GET["passwordResetMailSent"];
                
                if($value == 1){
                    ?>
                    
                    <h2 class="fs-title">Password reset mail sent! Check your inbox!</h2><br>

                    
                    
                    <?php
                }
            }
           
           ?>
         
          <!-- progressbar -->
          <ul id="progressbar">
            <li class="active">Login</li>
          </ul>
          <!-- fieldsets -->
          <fieldset>
            <h2 class="fs-title">Sign-in to your account</h2><br>
            <input type="text" name="username" required placeholder="Email ID" />
            <input type="password" name="password" required placeholder="Password" />
            <input type="submit" required name="submit" class="next action-button" value="Login" />
            <br>
            
            
            
<?php
if(isset($_POST["submit"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $user_password = "";
    $username = mysqli_real_escape_string($connection,$username);
    $password = mysqli_real_escape_string($connection,$password);
    
    $hashFormat = "$2y$10$";
    $salt = "iusesomecrazustrings223";
    $hashFormat .= $salt;
    
    $password = substr(crypt($password,$hashFormat),0,32);
    $query = "SELECT * FROM users WHERE email = '$username' ";
    $result = mysqli_query($connection,$query);
    
    while($row = mysqli_fetch_assoc($result)){
        $first_name = $row["first_name"];
        $user_id = $row["user_id"];
        $user_password = $row["password"];
        $user_type = $row["user_type"];
    }
   
    if(!$result || $user_password !== $password){
        
?>
 
   
    <h5 class="white">Invalid credentials entered!</h5><br>

<?php
    }
    else{
        $_SESSION["user_id"] = $user_id;
        $_SESSION["username"] = $username;
        $_SESSION["user_type"] = $user_type;
        $_SESSION["first_name"] = $first_name;
        if($user_type == 0){
            header("Location: employerdashboard.php");
        }
        else if($user_type == 1){
            header("Location: profilepage.php");
        }
    }
}
              
?>
            <h5 class = "white"> New here? <a href = "signUpForm.php">  Create an account</a> </h5>
            <br>
            <h5 class = "white"> Forgot your password? <a href = "forgotPassword.php">  Click here</a> </h5>
          </fieldset>
            
        </form>
    </body>
</html><!-- multistep form -->
