<?php
include("includes/db.php");
session_start();
ob_start();

if(!isset($_SESSION["USER_ID"]) || $_SESSION["USER_ID"] == -2){
    header("Location: index.php");
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
<?php
        $id = $_SESSION["USER_ID"];
        $query = "SELECT * FROM users WHERE USER_ID='$id'";
        $result = mysqli_query($connection,$query);
        $row = mysqli_fetch_assoc($result);
        if(!$result){
            die("Query failure!");
        }
        
?>

<div class="container">
    <div class="row">
        
            <div class="col-md-3">
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
        


        <?php
    
        $q = "SELECT * FROM jobs WHERE flag = '0'";
        $q = mysqli_query($connection,$q);
        while($r = mysqli_fetch_assoc($q)){
            
            ?>
            
            <div class="col col-lg-3" style="min-width: 600px;max-width:600px" >
            <div class="card mt-5 mb-5">
                <div class="card-header">
                        <?php echo $r["user_name"]; ?> <!-- NAME OF THE USER WHO POSTED THE JOB--> 
                    <div class="float-right">
                        <?php echo $r["date_time"]; ?> <!-- TIME IS IT POSTED--> 
                    </div>
                </div>

                <div class="card-body text-center">
                    <h4 class="card-title"> <?php echo $r["job_title"]; ?> </h4>     <!-- THE CATOGORY--> 
                    <p class="card-text"> <?php echo $r["job_description"]; ?></p>    <!-- DESCRIPTION-->
                </div>
            </div>
            <br>
            
            <?php
        }
    
        ?>
        
        



<!-- ********************************************************************-->        
<!-- IF YOU CAN ADD AN IMAGE WHILE POSTING THE JOB KEEP THIS OR DELETE IT--> 
<!-- ********************************************************************--> 
 
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


          <?php include("includes/contactmodal.php") ?>
    
</body>
 
</html>
