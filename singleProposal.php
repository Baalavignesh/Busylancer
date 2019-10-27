<?php
include("includes/db.php");
session_start();
ob_start();

if(!isset($_SESSION["USER_ID"])){
    header("Location: index.php");
}

include("includes/getDetails.php");


$freelancer_hirer = getDetails();

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
                    <h1> <i class="fas fa-cog"></i>Proposal</h1>
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
                        <img src="<?php echo $freelancer_hirer['profile_picture_url'] ?>" alt="profileimage" class="img-circle card-img-top">
                    </a>

                    <div class="card-footer">
                    <a href="#" class="style-none">
                            <h3 class= "text-center"><?php echo $freelancer_hirer["first_name"]; echo " " .$freelancer_hirer["last_name"]?></h3>
                        </a>
                    </div>
            </div>
        </div>

        <?php
            if(!isset($_GET["proposal_id"])){
                header("Location : index.php");
            }

            $pid = $_GET["proposal_id"];

            $query = "SELECT * FROM proposal join job on proposal.job_id = job.id join freelancer on proposal.freelancer_id = freelancer.id join user_account on freelancer.user_account_id = user_account.user_account_id join skill on job.main_skill_id = skill.id join complexity on job.complexity_id = complexity.id join expected_duration on job.expected_duration_id = expected_duration.id WHERE proposal.id =  '$pid'";
            $result = mysqli_query($connection,$query);
            $row = mysqli_fetch_array($result);
        ?>

                <div class="col-md-9">
                  <div class="card">
                    <div class="card-header">
                      <h4>Job details</h4>
                    </div>
                    <div class="card-body">
                      
                        <div class="form-group">
                          <label for="fname">Job title</label>
                          <input readonly name="fn" type="text" class="form-control" placeholder="First Name" value="<?php echo $row["job_title"];?>">
                        </div>
                        <div class="form-group">
                          <label for="lname">Job description</label>
                          <input readonly name="ln" type="text" class="form-control"  placeholder="Last Name" value='<?php echo $row["description"];?>'>
                        </div>
                        <div class="form-group">
                                <label for="dob">Expected duration</label>
                                <input readonly name="ln" type="text" class="form-control"  placeholder="Last Name" value='<?php echo $row["duration_text"];?>'>
                        </div>
                        <div class="form-group">
                                <label for="location">Complexity</label>
                                <input readonly name="ln" type="text" class="form-control"  placeholder="Last Name" value='<?php echo $row["complexity_text"];?>'>
                        </div>
                        <div class="form-group">
                                <label for="location">Main skill</label>
                                <input readonly name="ln" type="text" class="form-control"  placeholder="Last Name" value='<?php echo $row["skill_name"];?>'>
                        </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header">
                      <h4>Freelancer details</h4>
                    </div>
                    <div class="card-body">
                      
                        <div class="form-group">
                          <label for="fname">Freelancer name</label>
                          <input readonly name="fn" type="text" class="form-control" placeholder="First Name" value="<?php echo $row["first_name"];?>">
                        </div>
                        <div class="form-group">
                          <label for="lname">Payment amount</label>
                          <input readonly name="ln" type="text" class="form-control"  placeholder="Last Name" value='<?php echo $row[5];?>'>
                        </div>
                        <div class="form-group">
                                <label for="dob">Freelancer bio</label>
                                <input readonly name="ln" type="text" class="form-control"  placeholder="Last Name" value='<?php echo $row["overview"];?>'>
                        </div>
                        <div class="form-group">
                                <label for="location">Freelancer location</label>
                                <input readonly name="ln" type="text" class="form-control"  placeholder="Last Name" value='<?php echo $row["location"];?>'>
                        </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header">
                      <h4>Communication</h4>
                    </div>
                    <div class="card-body">
                      <div class="alert alert-success" role="alert">
                          <strong>Well done!</strong> You successfully read this important alert message.
                        </div>
                        <div class="alert alert-info" role="alert">
                          <strong>Heads up!</strong> This alert needs your attention, but it's not super important.
                        </div>
                        <form action="singleProposal.php" method="post">
                        <div class="form-group">
                                <label for="message">Message</label>
                                <input required name="message" type="text" class="form-control"  placeholder="Enter message">
                        </div>
                        </form>
                        <!-- display messages as blocks -->
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


          <?php include("includes/contactmodal.php");?>
       
    
</body>
 
</html>
