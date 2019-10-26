<?php

include("includes/db.php");
session_start();
ob_start();

if(isset($_SESSION["USER_ID"]) && $_SESSION["USER_ID"] !== -2){
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
        $id = $row["USER_ID"];
        $pass = $row["password"];
        if($pass == substr($hashedpass,0,32)){
            $query1 = "UPDATE users SET active='1' WHERE USER_ID='$id' ";
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
    $salt = "happydaytoallofyou123";

    $username = mysqli_real_escape_string($connection,$_POST["username"]);
    $password = md5(mysqli_real_escape_string($connection,$_POST["password"].$salt));
    
    
    $query = "SELECT * FROM user_account WHERE email = '$username' ";
    $result = mysqli_query($connection,$query);
    
    while($row = mysqli_fetch_assoc($result)){
        $USER_ID = $row["user_account_id"];
        $_SESSION["USER_ID"] = $USER_ID;
        $user_password = $row["password"];
    }

    if(!$result){
    ?>
        <h5 class="white">User not registered!</h5><br>
    <?php
    
    }
   
    else if($user_password !== $password){
    
        // echo $user_password;
        // echo $password;    
?>
 
    
    <h5 class="white">Invalid password entered!</h5><br>

<?php
    }
    else{

        //FREELANCER

        $query = "SELECT * FROM freelancer WHERE user_account_id = '$USER_ID' ";
        $result = mysqli_query($connection,$query);

        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $_SESSION["USER_TYPE"] = 1;
        }
        else{
            //HIRER

            $query = "SELECT * FROM hire_manager WHERE user_account_id = '$USER_ID' ";
            $result = mysqli_query($connection,$query);

            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                $_SESSION["USER_TYPE"] = 0;
            } 

        }



        if($_SESSION["USER_TYPE"] == 0){
            header("Location: employerdashboard.php");
        }
        else if($_SESSION["USER_TYPE"] == 1){
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
