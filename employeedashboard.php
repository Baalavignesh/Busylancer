<?php
include("includes/db.php");
session_start();
ob_start();

if(!isset($_SESSION["USER_ID"]) || $_SESSION["USER_ID"] == -2){
    header("Location: index.php");
}

include("includes/getDetails.php");

$freelancer = getDetails();

?>


<?php

    if(isset($_POST["submit"])){
        $fid = $freelancer["id"];
        $amt = $_POST["proposal_amount"];
        $job_id = $_POST["job_id"];
        $q = "INSERT INTO proposal(job_id,freelancer_id,payment_amount) VALUES('$job_id','$fid','$amt')";
        $r = mysqli_query($connection,$q);
        if(!$r){
            die("Query failed!" . mysqli_error($connection));
        }
        header("Location : employeedashboard.php"); 
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
                    <h1> <i class="fas fa-cog"></i>Dashboard</h1>
                </div>
            </div>
        </div>
    </header>

    

    <section>


<div class="container">
    <div class="row">
        
            <div class="col-md-3">
                    <div class="card mt-3">
                    <a href="#">
                        <img src="<?php echo $freelancer['profile_picture_url'] ?>" alt="profileimage" class="img-circle card-img-top">
                    </a>

                    <div class="card-footer">
                    <a href="#" class="style-none">
                            <h3 class= "text-center"><?php echo $freelancer["first_name"]; echo " " .$freelancer["last_name"]?></h3>
                        </a>
                    </div>
            </div>
        </div>
        


        <?php

        $fid = $freelancer["id"];
        $q = "SELECT * FROM has_skill WHERE freelancer_id = '$fid'";
        $r = mysqli_query($connection,$q);
        $skill_ids = array();
        while($row = mysqli_fetch_assoc($r)){
            array_push($skill_ids,$row["skill_id"]);
        }

        foreach ($skill_ids as $skill_id) {
            $q = "SELECT job.id,job.job_title,skill.skill_name,job.description,complexity.complexity_text,expected_duration.duration_text FROM job inner join skill on job.main_skill_id = skill.id inner join complexity on job.complexity_id = complexity.id inner join expected_duration on job.expected_duration_id = expected_duration.id WHERE main_skill_id = '$skill_id'";
            $result = mysqli_query($connection,$q);
            if(!$result){
                die("Query failed!" . mysqli_error($connection));
            }
            while($r = mysqli_fetch_assoc($result)){
                
                ?>
                
                <div class="col col-lg-3" style="min-width: 600px;max-width:600px" >
                <div class="card mt-5 mb-5">
                    <div class="card-body text-center">
                        <h4 class="card-title"> <?php echo $r["job_title"]; ?> </h4>     <!-- THE CATOGORY--> 
                        <p class="card-text"> <?php echo $r["description"]; ?></p>    <!-- DESCRIPTION-->
                        Skill required : <p class="card-text"> <?php echo $r["skill_name"]; ?></p>
                        Duration : <p class="card-text"> <?php echo $r["duration_text"]; ?></p>
                        Complexity : <p class="card-text"> <?php echo $r["complexity_text"]; ?></p>
                        <form name="propose" id="msform" action="employeedashboard.php" method="post">
                        <div class="md-form">
                            <input type="hidden" name="job_id" style="display:hidden" value="<?php echo $r["id"]?>">
                            <label for="form1">Proposal amount in rupees</label>
                            <input type="number" name="proposal_amount" class="form-control">
                            <br>
                            <input required type="submit" name="submit" class="btn btn-primary" value="Propose" />

                        </div>
                        </form>
                    </div>
                </div>
                </div>
                <br>
                
                <?php
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
