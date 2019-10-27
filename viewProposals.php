<?php
include("includes/db.php");
session_start();
ob_start();

if(!isset($_SESSION["USER_ID"])){
    header("Location: index.php");
}

include("includes/getDetails.php");

$hire_manager = getDetails();
?>


<html>
<head>

    <title>Welcome to Freelancer</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

<link rel="stylesheet" href="css/employerdashboard.css" type="text/css">
</head>

<body>
    <?php include("includes/navbar.php") ?>

    <header id ="main-header" class = "py-2 bg-primary text-white">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1> <i class="fas fa-cog"></i>Dashboard</h1>
                </div>
            </div>
        </div>
    </header>



    <section>

<div class="container">
    <div class="row">
        
            <div class="col-md-3 ">
                    <div class="card mt-3">
                    <a href="#">
                        <img src="<?php echo $hire_manager['profile_picture_url'] ?>" alt="profileimage" class="img-circle card-img-top">
                    </a>

                    <div class="card-footer">
                    <a href="#" class="style-none">
                            <h3 class= "text-center"><?php echo $hire_manager["first_name"]; echo " " .$hire_manager["last_name"]?></h3>
                        </a>
                    </div>
            </div>
        </div>

        <div class="col-lg-9">

        <?php
        if(isset($_GET["job_id"])){
            $job_id = $_GET["job_id"];
            $query = "SELECT * FROM proposal join job on proposal.job_id = job.id join freelancer on proposal.freelancer_id = freelancer.id join user_account on freelancer.user_account_id = user_account.user_account_id WHERE job_id = '$job_id'";
            $result = mysqli_query($connection,$query);
            while($row = mysqli_fetch_array($result)){
                ?>
                <div class="card mt-5 mb-5" id = "post"> 

                <div class="card-body text-center">
                    Name : <h4 class="card-title"> <?php echo $row["first_name"];?> </h4>     <!-- THE CATOGORY--> 
                    Time of proposal :<p class="card-text"> <?php echo $row["proposal_time"];?></p>    <!-- DESCRIPTION--> 

                    Amount :<p class="card-text"> <?php echo $row[5];?></p>    <!-- DESCRIPTION--> 
                    Location : <p class="card-text"> <?php echo $row["location"];?></p>
                    Overview : <p class="card-text"> <?php echo $row["overview"];?></p>
                    <a class="btn btn-primary" href = "singleProposal.php?proposal_id=<?php echo $row[0];?>">Consider proposal</a>
                </div>

                </div> 


                <?php


            }
        } 

        ?>
        </div>

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


          <?php include("includes/contactmodal.php");?>
       
    
</body>
 
</html>
