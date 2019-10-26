<?php
include("includes/db.php");
session_start();
ob_start();

if(!isset($_SESSION["USER_ID"]) || $_SESSION["USER_ID"] == -2){
    header("Location: index.php");
}

?>
<?php

function isAlreadySubmitted($job_id,$USER_ID){
    global $connection;
    $query = "SELECT * FROM acceptedjobs WHERE job_id='$job_id' AND USER_ID='$USER_ID'";
    $result = mysqli_query($connection,$query);
    
    if(!$result){
        die("Check failed!");
    }
    $numRows = mysqli_num_rows($result);
    if($numRows > 0){
        return true;
    }
    else{
        return false;
    }
}

?>




<html>
<head>

    <title>Welcome to Freelancer</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

<link rel="stylesheet" href="css/employeedashboard.css" type="text/css">
</head>

<body>
    <?php include("includes/navbar.php");?>

    <header id ="main-header" class = "py-2 bg-primary text-white">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1> <i class="fas fa-cog"></i>Jobs</h1>
                </div>
            </div>
        </div>
    </header>



    <section>

<div class="container">
    <div class="row">
        



    <?php
        $qr = "SELECT * FROM jobs WHERE category_id = ";
        
        if(isset($_GET["c1"])){
            if($_GET["c1"] == "true"){
                $qr .= "'1'";
                $res = mysqli_query($connection,$qr);
                if(!$res){
                    die("Select failed !");
                }
                while($ro = mysqli_fetch_assoc($res)){
                    if(isAlreadySubmitted($ro["job_id"],$_SESSION["USER_ID"])){
                    continue;
                }
                    ?>
                    
                    
                    <div class="card mt-5 mb-5">
                <div class="card-header">
                        <?php echo $ro["user_name"];?> <!-- NAME OF THE USER WHO POSTED THE JOB--> 
                    <div class="float-right">
                        <br>Date and Time : <?php echo $ro["date_time"];?> <!-- TIME IS IT POSTED--> 
                    </div>
                </div>

                <div class="card-body text-center">
                    <h4 class="card-title"> <?php echo $ro["job_title"];?> </h4>     <!-- THE CATOGORY--> 
                    <p class="card-text"> <?php echo $ro["job_description"];?></p>    <!-- DESCRIPTION--> 
                    
                    
                    <a class="btn btn-success" href = "categories.php?job_id=<?php echo $ro["job_id"]?>&USER_ID=<?php echo $_SESSION["USER_ID"]?>&user_name=<?php echo $_SESSION["first_name"]?>&poster_id=<?php echo $ro["USER_ID"] ?>&poster_name=<?php echo $ro["user_name"];?>">Submit</a>
                </div>

            </div>
                    
                    <?php
                }
                
                
            }
            $qr = "SELECT * FROM jobs WHERE category_id = ";
            if($_GET["c2"] == "true"){
                $qr .= "'2'";
                $res = mysqli_query($connection,$qr);
                if(!$res){
                    die("Select failed !");
                }
                while($ro = mysqli_fetch_assoc($res)){
                    if(isAlreadySubmitted($ro["job_id"],$_SESSION["USER_ID"])){
                    continue;
                }
                    ?>
                    
                    
                    <div class="card mt-5 mb-5">
                <div class="card-header">
                        <?php echo $ro["user_name"];?> <!-- NAME OF THE USER WHO POSTED THE JOB--> 
                    <div class="float-right">
                        <br>Date and Time : <?php echo $ro["date_time"];?> <!-- TIME IS IT POSTED--> 
                    </div>
                </div>

                <div class="card-body text-center">
                    <h4 class="card-title"> <?php echo $ro["job_title"];?> </h4>     <!-- THE CATOGORY--> 
                    <p class="card-text"> <?php echo $ro["job_description"];?></p>    <!-- DESCRIPTION--> 
                    
                    
<a class="btn btn-success" href = "categories.php?job_id=<?php echo $ro["job_id"]?>&USER_ID=<?php echo $_SESSION["USER_ID"]?>&user_name=<?php echo $_SESSION["first_name"]?>&poster_id=<?php echo $ro["USER_ID"] ?>&poster_name=<?php echo $ro["user_name"];?>">Submit</a>                    
                </div>

            </div>
                    
                    <?php
                }
                
                
            }
            
            $qr = "SELECT * FROM jobs WHERE category_id = ";
            if($_GET["c3"] == "true"){
                $qr .= "'3'";
                $res = mysqli_query($connection,$qr);
                if(!$res){
                    die("Select failed !");
                }
                while($ro = mysqli_fetch_assoc($res)){
                    if(isAlreadySubmitted($ro["job_id"],$_SESSION["USER_ID"])){
                    continue;
                }
                    ?>
                    
                    
                    <div class="card mt-5 mb-5">
                <div class="card-header">
                        <?php echo $ro["user_name"];?> <!-- NAME OF THE USER WHO POSTED THE JOB--> 
                    <div class="float-right">
                        <br>Date and Time : <?php echo $ro["date_time"];?> <!-- TIME IS IT POSTED--> 
                    </div>
                </div>

                <div class="card-body text-center">
                    <h4 class="card-title"> <?php echo $ro["job_title"];?> </h4>     <!-- THE CATOGORY--> 
                    <p class="card-text"> <?php echo $ro["job_description"];?></p>    <!-- DESCRIPTION--> 
                    
                    
<a class="btn btn-success" href = "categories.php?job_id=<?php echo $ro["job_id"]?>&USER_ID=<?php echo $_SESSION["USER_ID"]?>&user_name=<?php echo $_SESSION["first_name"]?>&poster_id=<?php echo $ro["USER_ID"] ?>&poster_name=<?php echo $ro["user_name"];?>">Submit</a>                    
                </div>

            </div>
                    
                    <?php
                }
                
                
            }
            
            $qr = "SELECT * FROM jobs WHERE category_id = ";
            if($_GET["c4"] == "true"){
                $qr .= "'4'";
                $res = mysqli_query($connection,$qr);
                if(!$res){
                    die("Select failed !");
                }
                while($ro = mysqli_fetch_assoc($res)){
                    if(isAlreadySubmitted($ro["job_id"],$_SESSION["USER_ID"])){
                    continue;
                }
                    ?>
                    
                    
                    <div class="card mt-5 mb-5">
                <div class="card-header">
                        <?php echo $ro["user_name"];?> <!-- NAME OF THE USER WHO POSTED THE JOB--> 
                    <div class="float-right">
                        <br>Date and Time : <?php echo $ro["date_time"];?> <!-- TIME IS IT POSTED--> 
                    </div>
                </div>

                <div class="card-body text-center">
                    <h4 class="card-title"> <?php echo $ro["job_title"];?> </h4>     <!-- THE CATOGORY--> 
                    <p class="card-text"> <?php echo $ro["job_description"];?></p>    <!-- DESCRIPTION--> 
                    
                    
<a class="btn btn-success" href = "categories.php?job_id=<?php echo $ro["job_id"]?>&USER_ID=<?php echo $_SESSION["USER_ID"]?>&user_name=<?php echo $_SESSION["first_name"]?>&poster_id=<?php echo $ro["USER_ID"] ?>&poster_name=<?php echo $ro["user_name"];?>">Submit</a>                    
                </div>

            </div>
                    
                    <?php
                }
                
                
            }
            
            $qr = "SELECT * FROM jobs WHERE category_id = ";
            if($_GET["c5"] == "true"){
                $qr .= "'5'";
                $res = mysqli_query($connection,$qr);
                if(!$res){
                    die("Select failed !");
                }
                while($ro = mysqli_fetch_assoc($res)){
                    if(isAlreadySubmitted($ro["job_id"],$_SESSION["USER_ID"])){
                    continue;
                }
                    ?>
                    
                    
                    <div class="card mt-5 mb-5">
                <div class="card-header">
                        <?php echo $ro["user_name"];?> <!-- NAME OF THE USER WHO POSTED THE JOB--> 
                    <div class="float-right">
                        <br>Date and Time : <?php echo $ro["date_time"];?> <!-- TIME IS IT POSTED--> 
                    </div>
                </div>

                <div class="card-body text-center">
                    <h4 class="card-title"> <?php echo $ro["job_title"];?> </h4>     <!-- THE CATOGORY--> 
                    <p class="card-text"> <?php echo $ro["job_description"];?></p>    <!-- DESCRIPTION--> 
                    
                    
<a class="btn btn-success" href = "categories.php?job_id=<?php echo $ro["job_id"]?>&USER_ID=<?php echo $_SESSION["USER_ID"]?>&user_name=<?php echo $_SESSION["first_name"]?>&poster_id=<?php echo $ro["USER_ID"] ?>&poster_name=<?php echo $ro["user_name"];?>">Submit</a>                    
                </div>

            </div>
                    
                    <?php
                }
                
                
            }
            
            $qr = "SELECT * FROM jobs WHERE category_id = ";
            if($_GET["c6"] == "true"){
                $qr .= "'6'";
                $res = mysqli_query($connection,$qr);
                if(!$res){
                    die("Select failed !");
                }
                while($ro = mysqli_fetch_assoc($res)){
                    if(isAlreadySubmitted($ro["job_id"],$_SESSION["USER_ID"])){
                    continue;
                }
                    ?>
                    
                    
                    <div class="card mt-5 mb-5">
                <div class="card-header">
                        <?php echo $ro["user_name"];?> <!-- NAME OF THE USER WHO POSTED THE JOB--> 
                    <div class="float-right">
                       <br> Date and Time : <?php echo $ro["date_time"];?> <!-- TIME IS IT POSTED--> 
                    </div>
                </div>

                <div class="card-body text-center">
                    <h4 class="card-title"> <?php echo $ro["job_title"];?> </h4>     <!-- THE CATOGORY--> 
                    <p class="card-text"> <?php echo $ro["job_description"];?></p>    <!-- DESCRIPTION--> 
                    
                    
<a class="btn btn-success" href = "categories.php?job_id=<?php echo $ro["job_id"]?>&USER_ID=<?php echo $_SESSION["USER_ID"]?>&user_name=<?php echo $_SESSION["first_name"]?>&poster_id=<?php echo $ro["USER_ID"] ?>&poster_name=<?php echo $ro["user_name"];?>">Submit</a>                    
                </div>

            </div>
                    
                    <?php
                }
                
                
            }
            
            $qr = "SELECT * FROM jobs WHERE category_id = ";
            if($_GET["c7"] == "true"){
                $qr .= "'7'";
                $res = mysqli_query($connection,$qr);
                if(!$res){
                    die("Select failed !");
                }
                while($ro = mysqli_fetch_assoc($res)){
                    if(isAlreadySubmitted($ro["job_id"],$_SESSION["USER_ID"])){
                    continue;
                }
                    ?>
                    
                    
                    <div class="card mt-5 mb-5">
                <div class="card-header">
                        <?php echo $ro["user_name"];?> <!-- NAME OF THE USER WHO POSTED THE JOB--> 
                    <div class="float-right">
                        <br>Date and Time : <?php echo $ro["date_time"];?> <!-- TIME IS IT POSTED--> 
                    </div>
                </div>

                <div class="card-body text-center">
                    <h4 class="card-title"> <?php echo $ro["job_title"];?> </h4>     <!-- THE CATOGORY--> 
                    <p class="card-text"> <?php echo $ro["job_description"];?></p>    <!-- DESCRIPTION--> 
                    
                    
<a class="btn btn-success" href = "categories.php?job_id=<?php echo $ro["job_id"]?>&USER_ID=<?php echo $_SESSION["USER_ID"]?>&user_name=<?php echo $_SESSION["first_name"]?>&poster_id=<?php echo $ro["USER_ID"] ?>&poster_name=<?php echo $ro["user_name"];?>">Submit</a>                    
                </div>

            </div>
                    
                    <?php
                }
                
                
            }
            
            $qr = "SELECT * FROM jobs WHERE category_id = ";
            if($_GET["c8"] == "true"){
                $qr .= "'8'";
                $res = mysqli_query($connection,$qr);
                if(!$res){
                    die("Select failed !");
                }
                while($ro = mysqli_fetch_assoc($res)){
                    if(isAlreadySubmitted($ro["job_id"],$_SESSION["USER_ID"])){
                    continue;
                }
                    ?>
                    
                    
                    <div class="card mt-5 mb-5">
                <div class="card-header">
                        <?php echo $ro["user_name"];?> <!-- NAME OF THE USER WHO POSTED THE JOB--> 
                    <div class="float-right">
                        <br>Date and Time : <?php echo $ro["date_time"];?> <!-- TIME IS IT POSTED--> 
                    </div>
                </div>

                <div class="card-body text-center">
                    <h4 class="card-title"> <?php echo $ro["job_title"];?> </h4>     <!-- THE CATOGORY--> 
                    <p class="card-text"> <?php echo $ro["job_description"];?></p>    <!-- DESCRIPTION--> 
                    
                    
<a class="btn btn-success" href = "categories.php?job_id=<?php echo $ro["job_id"]?>&USER_ID=<?php echo $_SESSION["USER_ID"]?>&user_name=<?php echo $_SESSION["first_name"]?>&poster_id=<?php echo $ro["USER_ID"] ?>&poster_name=<?php echo $ro["user_name"];?>">Submit</a>
                </div>

            </div>
                    
                    <?php
                }
                
                
            }
            
            $qr = "SELECT * FROM jobs WHERE category_id = ";
            if($_GET["c9"] == "true"){
                $qr .= "'9'";
                $res = mysqli_query($connection,$qr);
                if(!$res){
                    die("Select failed !");
                }
                while($ro = mysqli_fetch_assoc($res)){
                    if(isAlreadySubmitted($ro["job_id"],$_SESSION["USER_ID"])){
                    continue;
                }
                    ?>
                    
                    
                    <div class="card mt-5 mb-5">
                <div class="card-header">
                        <?php echo $ro["user_name"];?> <!-- NAME OF THE USER WHO POSTED THE JOB--> 
                    <div class="float-right">
                        <br>Date and Time : <?php echo $ro["date_time"];?> <!-- TIME IS IT POSTED--> 
                    </div>
                </div>

                <div class="card-body text-center">
                    <h4 class="card-title"> <?php echo $ro["job_title"];?> </h4>     <!-- THE CATOGORY--> 
                    <p class="card-text"> <?php echo $ro["job_description"];?></p>    <!-- DESCRIPTION--> 
                    
                    
<a class="btn btn-success" href = "categories.php?job_id=<?php echo $ro["job_id"]?>&USER_ID=<?php echo $_SESSION["USER_ID"]?>&user_name=<?php echo $_SESSION["first_name"]?>&poster_id=<?php echo $ro["USER_ID"] ?>&poster_name=<?php echo $ro["user_name"];?>">Submit</a>                   
                </div>

            </div>
                    
                    <?php
                }
                
                
            }
            
        }
        
    ?>
    </div>

</div>

    </section>

   
    <footer id="main-footer" class="bg-dark">
            <div class="container">
              <div class="row">
                <div class="col text-center py-4">
                  <h3>Freelancer</h3>
                  <p>Copyright &copy;
                    <span id="year"></span>
                  </p>
                  <button class="btn btn-primary" data-toggle="modal" data-target="#contactModal">Contact Us</button>
                </div>
              </div>
            </div>
    </footer>


          <?php include("includes/contactmodal.php") ?>
    
</body>
 
</html>
