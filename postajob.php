<?php
include("includes/db.php");
session_start();
ob_start();

if(!isset($_SESSION["USER_ID"]) || $_SESSION["USER_ID"] == -2 || $_SESSION["USER_ID"] == 1){
    header("Location: index.php");
}

include("includes/getDetails.php");
?>

<?php
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

                        if(isset($_POST["submit"])){

                            $user_account_id = $hire_manager["user_account_id"];
                            $hire_manager_id = $hire_manager["id"];
                            $title = $_POST["title"];
                            $main_skill = $_POST["main_skill"];
                            $expected_duration = $_POST["expected_duration"];
                            $complexity = $_POST["complexity"];
                            $description = $_POST["description"];

                            $q = "SELECT id FROM skill where skill_name = '$main_skill'";
                            $result = mysqli_query($connection,$q);
                            $row = mysqli_fetch_assoc($result);
                            $main_skill_id = $row["id"];

                            $q = "SELECT id FROM expected_duration where duration_text = '$expected_duration'";
                            $result = mysqli_query($connection,$q);
                            $row = mysqli_fetch_assoc($result);
                            $expected_duration_id = $row["id"];

                            $q = "SELECT id FROM complexity where complexity_text = '$complexity'";
                            $result = mysqli_query($connection,$q);
                            if(!$result){
                                die("Query complexity failed!" . mysqli_error($connection));
                            }
                            $row = mysqli_fetch_assoc($result);
                            $complexity_id = $row["id"];


                            $query = "insert into job(job_title,hire_manager_id,expected_duration_id,complexity_id,description,main_skill_id) values('$title','$hire_manager_id','$expected_duration_id','$complexity_id','$description','$main_skill_id')";
                            
                            $result = mysqli_query($connection,$query);
                            if(!$result){
                                die("Query failed!" . mysqli_error($connection));
                            }

                            if(!empty($_POST["skill_list"])){
                                foreach ($_POST["skill_list"] as $currentSkill) {
                                    $query3 = "INSERT INTO other_skills VALUES((SELECT job.id FROM job where job_title = '$title'),(SELECT id FROM skill where skill_name = '$currentSkill'))";
                                    $result3 = mysqli_query($connection,$query3);
                                    if(!$result3){
                                        die("Query 3 failed!" . mysqli_error($connection));
                                    }
                                }
                            }

 
                            
                            ?>
                            
                            <div class="mt-4">
                            <h6>Your job has been posted !</h6>
                            </div>
                            
                            <?php

                        }
                        
                            
                        ?>
            

                    
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

                                    <?php

                                    $q = "SELECT * FROM skill";
                                    $skillnames = array();
                                    $result = mysqli_query($connection,$q);
                                    while($row = mysqli_fetch_assoc($result)){
                                        array_push($skillnames,$row["skill_name"]);
                                    }; 

                                    ?>


                                  <div class="form-group">
                                    <label for="main_skill">Choose the main skill required for the job</label>
                                    
                                    <select name="main_skill" class="form-control">

                                        <?php
                                        foreach ($skillnames as $skill_name) {

                                            ?>

                                            <option value="<?php echo $skill_name ?>"><?php echo $skill_name ?></option>

                                            <?php

                                        }


                                        ?>
                                            

                                    </select>



                                  </div>


                                <div class="form-group">
                                  <label for="skill_list[]">Other Skills</label>
                                  <br>


                                  <?php

                                    foreach ($skillnames as $skill_name) {
                                        echo $skill_name;
                                        ?>

                                            <input type="checkbox" name="skill_list[]" value="<?php echo $skill_name?>">

                                        <?php

                                    }


                                    ?>
                                </div>


                                <div class="form-group">
                                    <label for="expected_duration">Expected duration</label>
                                    
                                    <select name="expected_duration" class="form-control">

                                        <?php

                                        $q = "SELECT * FROM expected_duration";
                                        $expected_durations = array();
                                        $result = mysqli_query($connection,$q);
                                        while($row = mysqli_fetch_assoc($result)){
                                            array_push($expected_durations,$row["duration_text"]);
                                        }; 
                                        foreach ($expected_durations as $expected_duration) {
                                            ?>

                                            <option value="<?php echo $expected_duration ?>"><?php echo $expected_duration ?></option>

                                            <?php

                                        }


                                        ?>
                                            

                                    </select>



                                  </div>


                                  <div class="form-group">
                                    <label for="complexity">Complexity</label>
                                    
                                    <select name="complexity" class="form-control">

                                        <?php

                                        $q = "SELECT * FROM complexity";
                                        $complexities = array();
                                        $result = mysqli_query($connection,$q);
                                        while($row = mysqli_fetch_assoc($result)){
                                            array_push($complexities,$row["complexity_text"]);
                                        }; 
                                        foreach ($complexities as $complexity) {
                                            ?>

                                            <option value="<?php echo $complexity ?>"><?php echo $complexity ?></option>

                                            <?php

                                        }


                                        ?>
                                            

                                    </select>



                                  </div>


                                  <div class="form-group">
                                    <label for="description">Tell us more about your project</label>
                                    <textarea required class="form-control" name="description" row="3"></textarea>
                                  </div>


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
