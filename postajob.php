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
                    <h1> <i class="fas fa-cog"></i>Post a Job</h1>
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
                        <div class="mt-4">
                            <h6>Jobs Posted : <?php echo $row["jobs_posted"]?> </h6>
                        </div>
                    </div>
            </div>
        </div>




        <div class="col-lg-9">
                       <?php

                        if(isset($_POST["submit"])){
                            $newjobs =  $row["jobs_posted"] + 1;
                            $employerBro = "UPDATE users SET jobs_posted = '$newjobs' WHERE user_id='$id'";
                            $employeres = mysqli_query($connection,$employerBro);
                            if(!$employeres){
                                die("Failed to update the jobs posted.");
                            }
                            $category = $_POST["category"];
                            $q = "SELECT category_id FROM categories WHERE category_name = '$category'";
                            $res = mysqli_query($connection,$q);
                            if(!$res){
                                die("Category cannot be fetched !");
                            }
                            $r = mysqli_fetch_assoc($res);
                            $category_id = $r["category_id"];


                            $title = $_POST["title"];
                            $description = $_POST["description"];
                            $user_id = $_SESSION["user_id"];
                            $user_name = $_SESSION["first_name"];
                            $q2 = "INSERT INTO jobs(job_title,job_description,user_id,user_name,category_id) VALUES('$title','$description','$user_id','$user_name','$category_id')";
                            $res = mysqli_query($connection,$q2);
                            if(!$res){
                                die("Insert operation failed !");
                            }
                            else{
                            
                            ?>
                            
                            <div class="mt-4">
                            <h6>Your job has been posted !</h6>
                            </div>
                            
                            <?php
                            }

                        }
                        
                            
                        ?>
                        
                        
                        
                        <?php include("includes/employerbar.php") ?>
        

                    
                            <div class="card mt-5">
                              <div class="card-header">
                                <h4>Post a Job</h4>
                              </div>
                              <div class="card-body">
                                <form name="postJob" action="postajob.php" method="post">
                                  <div class="form-group">
                                    <label for="title">Enter a name/title for your project</label>
                                        <input name="title" type="text" class="form-control" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="category">Choose the category</label>
                                    

                                    <select name="category" class="form-control">
                                            <option>Web Development</option>
                                            <option>AI/Machine learning Engineer</option>
                                            <option>Mobile App Development</option>
                                            <option>Photoshop</option>
                                            <option>Python Developer</option>
                                            <option>Marketing</option>
                                            <option>C/C++</option>
                                            <option>JavaScript developer</option>
                                            <option>Content Writing</option>
                                        </select>
                                  </div>
                                  <div class="form-group">
                                    <label for="bio">Tell us more about your project</label>
                                    <textarea required class="form-control" name="description" row="3"></textarea>
                                  </div>


<!-- ********************************************************************-->        
<!-- IF YOU CAN ADD AN IMAGE WHILE POSTING THE JOB KEEP THIS OR DELETE IT--> 
<!-- ********************************************************************--> 








                                  <button name="submit" type="submit" class="btn btn-primary        btn-lg"> Post </button> 
                                </form>
                              </div>
                            </div>     
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
