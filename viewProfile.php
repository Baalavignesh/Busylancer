<?php
include("includes/db.php");
session_start();
ob_start();

if(!isset($_SESSION["USER_ID"]) || $_SESSION["USER_ID"] == -2){
    header("Location: index.php");
}
?>


<?php

if(isset($_GET["USER_ID"])){
    $id = $_GET["USER_ID"];
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
</head>

<body>
    <?php include("includes/navbar.php");?>
    <header id ="main-header" class = "py-2 bg-primary text-white">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1> <i class="fas fa-cog"></i>Profile</h1>
                </div>
            </div>
        </div>
    </header>
    <form>
       <?php
        $query = "SELECT * FROM users WHERE USER_ID='$id'";
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
                                    <img src="img/<?php echo $row['profile_picture']?>" alt="profileimage" class="img-circle">
                                    <h3 class= "text-center">Avatar</h3>
                        </div>

                <div class="col-md-9">
                  <div class="card">
                    <div class="card-header">
                      <h4>Profile</h4>
                    </div>
                    <div class="card-body">
                      
                        <div class="form-group">
                          <label for="fname">First Name</label>
                          <input readonly name="fn" type="text" class="form-control" placeholder="First Name" value="<?php echo $row["first_name"];?>">
                        </div>
                        <div class="form-group">
                          <label for="lname">Last Name</label>
                          <input readonly name="ln" type="text" class="form-control"  placeholder="Last Name" value="<?php echo $row["last_name"];?>">
                        </div>
                        <div class="form-group">
                                <label for="dob">Date of Birth</label>
                                <input readonly type = "date" name="dob" class="form-control" min = "1900-01-01" max = "2018-12-31" value="<?php echo $row["dob"];?>"> 
                        </div>
                        <div class="form-group">
                                <label for="number">Mobile Number</label>
                                <input readonly name="phone" type="tel" class="form-control"  maxlength="10" placeholder="Number" value="<?php echo $row["phone_number"];?>">
                        </div>
                        
                        <div class="form-group">
                                <label for="number">Email ID</label>
                                <input readonly name="emailID" type="text" class="form-control"  placeholder="Email" value="<?php echo $row["email"];?>">
                        </div>

                        <div class="form-group">
                          <label for="bio">Bio</label>
                          <input readonly name="bio" class="form-control" name="editor1" value="<?php echo $row["bio"]?>">
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