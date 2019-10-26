<?php
    
    session_start();
    ob_start();

    include("includes/db.php");
    if(!isset($_SESSION["USER_ID"])){
        ?>
            
<script>
    console.log("Session variables are not set!");
</script>
       <?php
        $_SESSION["USER_ID"] = -2;
        $_SESSION["USER_TYPE"] = -1;
    }

    
?>


<html>
<head>

    <title>Welcome to Freelancer</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel = "stylesheet" href="css/index.css" type="text/css">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

</head>

<body>
    <div class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
        <div class="container">
            <a href = "index.php" class = "navbar-brand"> Freelancer</a>
            <button class="navbar-toggler" data-toggle = "collapse" data-target = "#navbarCollapse">
                <span class="navbar-toggle-icon"></span>    
            </button>
            <div class="collapse navbar-collapse" id = "navbarCollapse">
                <div class="navbar-nav ml-auto">
                    <li class = "nav-item">
                        <a href = "index.php" class = "nav-link">Home</a>
                    </li>
                    <li class = "nav-item">
                        <?php
                        
                        if($_SESSION["USER_ID"] == -2){
                            ?>
                            
                            <a href = "#explore-head-section" class = "nav-link">Explore</a>
                            
                            <?php
                        }
                        else{
                            if($_SESSION["USER_TYPE"] == "0"){
                            ?>
                                <a href = "#explore-head-section" class = "nav-link">Hire</a>
                            <?php
                            
                            }
                            else if($_SESSION["USER_TYPE"] == "1"){
                                ?>
                                
                                <a href = "#explore-head-section" class = "nav-link">Work</a>
                                <?php
                            }
                        }
                        
                        ?>
                        
                        
                    </li>
                    <li class = "nav-item">
                       <?php
                        
                        if($_SESSION["USER_ID"] == -2){
                            ?>
                            
                        <a href = "login.php" class = "nav-link">Login</a>

                            
                            <?php
                        }
                        else{
                            
                            ?>
                        <a href = "profilepage.php" class = "nav-link">Profile & Notifications</a>
                         
                         <?php
                        }
                        ?>
                    </li>
                    
                    <?php
                    
                    if($_SESSION["USER_ID"] != -2){
                        ?>
                        
                        <li class="nav-item"><a class="nav-link" href="includes/logout.php">Logout</a></li>
                        
                        <?php
                    }
                    
                    ?>
                    
                    

                </div>
            </div>
        </div>

    </div>

        <header id="home-section">
            <div class="dark-overlay">
              <div class="home-inner1 container">
                <div class="row">
                  <div class="col-lg-12 d-none d-lg-block">
                    <h1 class="display-4" style="text-align:center;"> <strong>Hire freelancers.<br>
Make things happen.™</strong> 
                    </h1>
                    <div class="cont-box pt-5">
                    <div class="p-3 d-flex justify-content-center lead">
                        <i class="fas fa-check fa-2x"></i>
                        <div class="pt-2 pl-3">
Post a job (it’s free)                        </div>
                    </div>

                    <div class="p-3 d-flex justify-content-center lead">
                        <i class="fas fa-check fa-2x"></i>
                        <div class="pt-2 pl-3">
Frelancers come to you
                   </div>
                    </div>

                      <div class="p-3 d-flex justify-content-center lead">
                          <i class="fas fa-check fa-2x"></i>
                          <div class="pt-2 pl-3">  
Collaborate easily                          </div>
                      </div>

                      <div class="p-5 d-flex justify-content-center btn">

                          <a class="btn btn-lg btn-outline-info" href="signUpForm.php">Sign-up</a>
                      </div>
                    </div>
                  </div>
        

                </div>
              </div>
            </div>
          </header>



          <section id="explore-head-section">
            <div class="container">
              <div class="row">
                <div class="col text-center py-5">
                  <h1 class="display-4">Why should I hire a freelancer?</h1>
                  <p class="lead">Maybe you've dreamt up a mobile app but don't know how to build it. Maybe you need some stunning design to grab your customers' attention. Maybe you want a website that turbocharges your sales. Whatever you're looking to build or create, a freelancer can help you get it done.</p>
                  
                </div>
              </div>
            </div>
          </section>
        
          <!-- EXPLORE SECTION -->
          <section id="explore-section" class="bg-light text-muted py-5">
            <div class="container">
              <div class="row">
                <div class="col-md-6">
                  <img src="img/explore.jpg" alt="" class="img-fluid mb-3 rounded-circle">
                </div>
                <div class="col-md-6">
                  <h3>Still not convinced? Check out the reviews!</h3>
                  <p>Here are just some of the things you could get done on Freelancer.com </p>
                  <div class="d-flex">
                    <div class="p-4 align-self-start">
                      <i class="fas fa-check fa-2x"></i>
                    </div>
                    <div class="p-4 align-self-end">
We got bids almost instantaneously! Never thought I could outsource small projects and get results as good as this!                    </div>
                  </div>
        
                  <div class="d-flex">
                    <div class="p-4 align-self-start">
                      <i class="fas fa-check fa-2x"></i>
                    </div>
                    <div class="p-4 align-self-end">
                        I never thought that all these skills that I'd learnt in my college days would be profitable to me! Thanks to Freelancer, they are!
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        
          
        
          
      
          <!-- FOOTER -->
          <footer id="main-footer" class="bg-dark">
            <div class="container">
              <div class="row">
                <div class="col text-center py-4">
                  <h3>Freelancer</h3>
                  <p>Copyright &copy;
                    <span id="year"></span>
                  </p>
                </div>
              </div>
            </div>
          </footer>

        
          <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
            crossorigin="anonymous"></script>
        
          <script>
            // Get the current year for the copyright
            $('#year').text(new Date().getFullYear());
        
            // Init Scrollspy
            $('body').scrollspy({ target: '#main-nav' });
        
            // Smooth Scrolling
            $("#main-nav a").on('click', function (event) {
              if (this.hash !== "") {
                event.preventDefault();
        
                const hash = this.hash;
        
                $('html, body').animate({
                  scrollTop: $(hash).offset().top
                }, 800, function () {
        
                  window.location.hash = hash;
                });
              }
            });
          </script>
        </body>
        
        </html>


