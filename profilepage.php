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

if(isset($_GET["deletepropic"])){
    $fid = $freelancer["id"];
    $del = "UPDATE freelancer SET profile_picture_url='img/avatar.png' WHERE id='$fid'";
    $del = mysqli_query($connection,$del);
    header("Location: profilepage.php");
}

?>

<?php

if(isset($_POST["submit"])){

    $path = "img/";
    $file = $_FILES['propic'];
    $file_name = $file["name"];
    $file_type = $file ['type'];
    $file_size = $file ['size'];
    $file_path = $file ['tmp_name'];

    //Restriction to the image. You can upload any types of file for example video file, mp3 file, .doc or .pdf just mention here in OR condition. 

    if($file_name!="" && ($file_type="image/jpeg"||$file_type="image/png"||$file_type="image/gif")&& $file_size<=614400){
        move_uploaded_file($file_path,$path . $file_name);
    }
    else{
        $file_name = "";
    }
    $fid = $freelancer['id'];
    
    $fn = $_POST["fn"];
    $ln = $_POST["ln"];
    $dob = strtotime($_POST["dob"]);
    $dob = date('Y-m-d H:i:s', $dob);
    $location = $_POST["location"];
    $overview = $_POST["overview"];
    
    $user_account_id = $_SESSION["USER_ID"];

    $query1="UPDATE `user_account` SET `first_name`='$fn',`last_name`='$ln',`dob`='$dob' WHERE user_account_id='$user_account_id'";

    $result1 = mysqli_query($connection,$query1);
    if(!$result1){
        die("Query 1 failed!" . mysqli_error($connection));
    }


    if($file_name != ""){
        $file_name = "img/".$file_name;
    }
    else{
       $file_name = "img/avatar.png"; 
    }
    $query1 = "UPDATE freelancer SET profile_picture_url='$file_name',overview='$overview',location='$location' WHERE id='$fid'";
    $result1 = mysqli_query($connection,$query1);
    if(!$result1){
        die("Query 2 failed!" . mysqli_error($connection));
    }

    
    $querydel = "delete from has_skill where freelancer_id = all(select id from freelancer where user_account_id = '$user_account_id')";
    $resultdel = mysqli_query($connection,$querydel);
    if(!$resultdel){
        die("Deletion failed!" . mysqli_error($connection));
    }

    if(!empty($_POST["skill_list"])){
        foreach ($_POST["skill_list"] as $currentSkill) {
            $query3 = "INSERT INTO has_skill VALUES((SELECT freelancer.id FROM freelancer natural join user_account where user_account_id = '$user_account_id'),(SELECT id FROM skill where skill_name = '$currentSkill'))";
            $result3 = mysqli_query($connection,$query3);
            if(!$result3){
                die("Query 3 failed!" . mysqli_error($connection));
            }
        }
    }

    header("Location: profilepage.php");

    
    
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

<link rel="stylesheet" href="css/profilepage.css" type="text/css">

<?php include("includeCountries.php"); ?>

</head>

<body onload="addCountries()">
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
    <form method="post" action="profilepage.php" enctype="multipart/form-data">
       <?php
        $id = $_SESSION["USER_ID"];
        $query = "SELECT * FROM freelancer WHERE id='$id'";
        $result = mysqli_query($connection,$query);
        $row = mysqli_fetch_assoc($result);
        if(!$result){
            die("Query failure!");
        }
        
        ?>
        <section id="profile">
            <div class="container">
              <div class="row">

                    <div class="col-md-3">
                                    <img src="<?php echo $freelancer['profile_picture_url']?>" alt="profileimage" class="img-circle">
                                    <h3 class= "text-center">Your Avatar</h3>
                                Edit Image
                                <input type="file" id="propic" name="propic" class="btn btn-primary btn-block" placeholder="Edit">
                            <a href="profilepage.php?deletepropic=1" class="btn btn-danger btn-block">Delete Image</a>
                        </div>

                <div class="col-md-9">
                  <div class="card">
                    <div class="card-header">
                      <h4>Edit Profile</h4>
                    </div>
                    <div class="card-body">
                      
                        <div class="form-group">
                          <label for="fname">First Name</label>
                          <input name="fn" type="text" class="form-control" placeholder="First Name" value="<?php echo $freelancer["first_name"];?>">
                        </div>
                        <div class="form-group">
                          <label for="lname">Last Name</label>
                          <input name="ln" type="text" class="form-control"  placeholder="Last Name" value='<?php echo $freelancer["last_name"];?>'>
                        </div>
                        <div class="form-group">
                                <label for="dob">Date of Birth</label>
                                <input type = "date" name="dob" class="form-control" min = "1900-01-01" max = "2018-12-31" value="<?php echo $freelancer["dob"];?>"> 
                        </div>
                        <div class="form-group">
                                <label for="location">Location</label>
                                <select name="location" id="location" class="form-control"  placeholder="Location" value="<?php echo $freelancer["location"];?>"></select>
                        </div>

                        <div class="form-group">
                          <label for="overview">Overview</label>
                          <input name="overview" id="overview" class="form-control" value="<?php echo $freelancer["overview"]?>">
                        </div>

                        <div class="form-group">
                          <label for="overview">Skills</label>
                          <br>


                          <?php
                           
                            $q = "SELECT * FROM skill";
                            $skillnames = array();
                            $result = mysqli_query($connection,$q);
                            while($row = mysqli_fetch_assoc($result)){
                                array_push($skillnames,$row["skill_name"]);
                            }; 

                            $user_account_id = $_SESSION["USER_ID"];

                            $q = "select * from user_account natural join freelancer join has_skill on freelancer.id = has_skill.freelancer_id join skill on has_skill.skill_id = skill.id where user_account_id = '$user_account_id'";
                            $result = mysqli_query($connection,$q);
                            $existing_skills = array();
                            while($row = mysqli_fetch_assoc($result)){
                                array_push($existing_skills,$row["skill_name"]);
                            }; 


                            foreach ($skillnames as $skill_name) {
                                echo $skill_name;
                                if(in_array($skill_name, $existing_skills)){
                                    ?>

                                    <input type="checkbox" checked name="skill_list[]" value="<?php echo $skill_name?>">

                                    <?php
                                }
                                else{
                                    ?>

                                    <input type="checkbox" name="skill_list[]" value="<?php echo $skill_name?>">

                                    <?php
                                }
                            }


                            ?>
                        </div>

                        
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-block" value="Save" name="submit">
                        </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </section>
    
    </form>
        
</body>
 
</html>