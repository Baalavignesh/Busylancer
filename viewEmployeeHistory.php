<?php
include("includes/db.php");
session_start();
ob_start();

if(!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == -2){
    header("Location: index.php");
}

?>

<?php
$id = $_SESSION["user_id"];
$query = "SELECT * FROM users WHERE user_id = '$id'";
$result = mysqli_query($connection,$query);
if(!$result){
    die("Failes!");
}

$row = mysqli_fetch_assoc($result);

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
                    <h1> <i class="fas fa-cog"></i>History of job requests</h1>
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
                        <img src="img/<?php echo $row['profile_picture'] ?>" alt="profileimage" class="img-circle card-img-top">
                    </a>

                    <div class="card-footer">
                    <a href="#" class="style-none">
                            <h3 class= "text-center"><?php echo $_SESSION["first_name"]; echo " " .$row["last_name"]?></h3>
                        </a>
                    </div>
            </div>
        </div>




        <div class="col-lg-9">

            <?php
            $id = $_SESSION["user_id"];
            $q = "SELECT * FROM acceptedjobs WHERE user_id = '$id'";
            $R = mysqli_query($connection,$q);
            if(!$R){
                die("Query failed");
            }
    
            while($ROW = mysqli_fetch_assoc($R)){
                ?>
                
            <div class="card mt-5 mb-5" id = "post"> 
                <div class="card-header">
                      <div class="text-center">
                        Job posted by : <?php echo $ROW["poster_name"];?> <!-- TIME IS IT POSTED--> 
                    </div>  
                       <div class="text-center">
                        Date and Time of requesting the Job: <?php echo $ROW["date_time"];?> <!-- TIME IS IT POSTED--> 
                    </div>
                </div>
                <?php
                $idwww = $ROW["job_id"];
                $qwww = "SELECT * FROM jobs WHERE job_id = '$idwww'";
                $Rwww = mysqli_query($connection,$qwww);
                if(!$Rwww){
                    die("Query failed");
                }
    
                $ROWwww = mysqli_fetch_assoc($Rwww);
                ?>
                <div class="card-body text-center">
                    <h4 class="card-title"> <?php echo $ROWwww["job_title"];?> </h4>     <!-- THE CATOGORY--> 
                    <p class="card-text"> <?php echo $ROWwww["job_description"];?></p>    <!-- DESCRIPTION-->
<!--                        <a class="btn btn-danger" hreft = "#" > Decline</a>-->
                    <p class="card-text"> <?php if($ROW["flag"] == "1"){echo "Your job request has been accepted! The employer will contact you soon.";}
                        else{
                            echo "Job request pending.";
                        }?></p>
                </div>

            </div>    
                
                <?php
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
