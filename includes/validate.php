<?php

include("db.php");


if(isset($_POST["email"])){
    
    $email = $_POST["email"];
    
    $email = mysqli_real_escape_string($connection,$email);
    
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        echo "Invalid EMAIL!";
    }
    else{
        $query = "SELECT id FROM user_account WHERE email = '$email' ";
        
        $result = mysqli_query($connection,$query);
        $rows = mysqli_num_rows($result);
        if($rows != 0){
            echo "This email is already registered !";
        }
        else{
            echo "Awesome!";
        }
    }
    
    
}

?>