<?php
include("includes/db.php");
session_start();
ob_start();

if(!isset($_SESSION["USER_ID"]) || $_SESSION["USER_ID"] == -2){
    header("Location: index.php");
}
?>

<?php

//get superglobal to post into the acceptedjobs db

if(isset($_GET["job_id"])){
    $job_id = $_GET["job_id"];
    $USER_ID = $_GET["USER_ID"];
    $user_name = $_GET["user_name"];
    $poster_id = $_GET["poster_id"];
    $poster_name = $_GET["poster_name"];
    
    
    $quer = "INSERT INTO acceptedjobs(job_id,USER_ID,user_name,poster_id,poster_name) VALUES('$job_id','$USER_ID','$user_name','$poster_id','$poster_name')";
    $resu = mysqli_query($connection,$quer);
    if(!$resu){
        die("Insert into accepted jobs failed !");
    }
    
    ?>
    
    <script>
        history.go(-1);
</script>
    
    <?php
}

?>


<html>
<head>

    <title>Welcome to Freelancer</title>
    <script>
        var isSelected = new Array(10);
        for(var i=0;i<10;i++){
            isSelected[i] = 0;
        }
    </script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

<link rel="stylesheet" href="css/categories.css" type="text/css">
</head>

<body>
    <?php include("includes/navbar.php");?>
   
   
   
    <header id ="main-header" class = "py-2 bg-primary text-white">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1> <i class="fas fa-cog"></i>  Select the Categories</h1>
                </div>
                
            </div>
        </div>
    </header>

<form onsubmit="return sendGET();" action="categories.php" method="post">
    <section id="catogories">
        <div class="container">
            <div class="row">
                    <div class="col-lg-4 subint ">
                            <a class="link" style="text-decoration : none;" onclick="select(1)" id = "wd">
                            <img class="card-img-top"  src="https://cdn-images-1.medium.com/max/853/1*zJkojKNpFD9HFGPJLCs15Q.jpeg" alt="profileimage">
                             <div class = "overlay">
                                    <h4>Web Development</h4>
                             </div>
                            </a>
                            
                    </div>
                
                    <div class="col-lg-4 col-md-6 subint">
                            <a id = "ai" class="link" style="text-decoration : none;" onclick="select(2)">
                            <img class="card-img-top pt-1" src="https://www.analyticsinsight.net/wp-content/uploads/2018/09/ArtificialIntelligence-Jobs.png"  name = "">
                            <div class = "overlay">
                               <h4>AI/machine learning engineer</h4>
                            </div>
                        </a>
                    </div>
               

                
                         <div class="col-lg-4 col-md-6 mb-3 subint">
                            
                             <a id = "app" style="text-decoration : none;" onclick="select(3)">
                            <img class="card-img-top  pt-4" src="https://images.yourstory.com/production/document_image/mystoryimage/qytxhmcx-mobile-app-development-gtech.jpeg?fm=png&auto=format"   name = "  ">
                            <div class = "overlay">
                               <h4 id="hidden">Mobile App Development</h4>
                            </div>
                        </a>
                         </div>
                
            
            </div>


            <div class="row">
                    <div class="col-lg-4 col-md-6 mb-3 subint">
                        <a id = "ps" style="text-decoration : none;" onclick="select(4)">
                            <img class="card-img-top  " src="http://depoalistemlab.weebly.com/uploads/3/7/9/0/37904907/ps_orig.jpg"  name = "  ">
                            <div class = "overlay">
                               <h4 id="hidden"> Photoshop</h4>
                            </div>
                        </a>
                     </div>
                
                
                     <div class="col-lg-4 col-md-6 mb-3 subint">
                            
                         <a id = "py"  style="text-decoration : none;"  onclick="select(5)">
                        <img class="card-img-top  pt-5" src="https://cdn.techinasia.com/wp-content/uploads/2015/09/python-techinasia-720x300.jpg" name = "  "  >
                        <div class = "overlay">
                           <h4 id="hidden">Python developer</h4>
                        </div>
                        </a>
                     </div>
                

                
                    




                     <div class="col-lg-4 col-md-6 mb-3 subint">
                            
                        <a id = "marketing" style="text-decoration : none;"  onclick="select(6)">
                       <img class="card-img-top  " src="https://www.proschoolonline.com/wp-content/uploads/2019/03/marketing.jpg" name = "  " >
                       <div class = "overlay">
                          <h4 id="hidden">Marketing</h4>
                       </div>
                       </a>
                    </div>
                
            
            </div>



            <div class="row">
                   

                <div class="col-lg-4 col-md-6 mb-3 subint">
                           
                    <a id = "c" style="text-decoration : none;"  onclick="select(7)">
                   <img  class="card-img-top  " src="https://fsconline.info/wp-content/uploads/2015/09/c-cpp-programming.jpg" name = "  ">
                   <div class = "overlay">
                      <h4 id="hidden">C/C++</h4>
                   </div>
                   </a>
                </div>
                
                     <div class="col-lg-4 col-md-6 mb-3 subint">
                            
                         <a id="js" style="text-decoration : none;" onclick="select(8)">
                        <img  class="card-img-top pt-4 " src="https://static.wixstatic.com/media/273dcf_7555d74ac8b94f449d21dafbb9cdd74c.jpg" name = "  ">
                        <div class = "overlay">
                           <h4 id="hidden">JavaScript developer</h4>
                        </div>
                        </a>
                     </div>

                
                     <div class="col-lg-4 col-md-6 mb-3 subint">
                            
                         <a id = "content" style="text-decoration : none;" onclick="select(9)">
                        <img class="card-img-top  " src="https://ect.co.in/wp-content/uploads/2016/04/Careers-in-Content-Writing.jpg" name = "  "  >
                        <div class = "overlay">
                           <h4 id="hidden">Content Writing</h4>
                        </div>
                        </a>
                     </div>
            
            </div>


        </div>
    </section>
    <button type="submit" class="btn btn-primary btn-lg btn-block mb-5 mt-5 p-2">Submit</button>
    </form>
  

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


          <?php include("includes/contactmodal.php")?>
              
    
    <script>
        function select(y){
            
            var x = "";
            switch(y){
                case 1:
                    x = document.getElementById("wd");
                    break;
                case 2:
                    x = document.getElementById("ai");

                    break;
                case 3:
                    x = document.getElementById("app");

                    break;
                case 4:
                    x = document.getElementById("ps");

                    break;
                case 5:
                    x = document.getElementById("py");

                    break;
                case 6:
                    x = document.getElementById("marketing");

                    break;
                case 7:
                    x = document.getElementById("c");

                    break;
                case 8:
                    x = document.getElementById("js");

                    break;
                case 9:
                    x = document.getElementById("content");

                    break;
            }
            if(isSelected[y]){
                x.style.opacity = 1;
                isSelected[y] = 0;
            }
            else{
            isSelected[y] = 1;
            x.style.opacity = 0.5;
            }
        }
        
        function sendGET(){
            
            var getter = "http://freelancer.ueuo.com/jobsavailable.php?";
            if(isSelected[1] == 1){
                getter = getter + "c1=true";
            }
            else{
                getter = getter + "c1=false";
            }
            for(var i=2;i<=9;i++){
                if(isSelected[i] == 1){
                    getter = getter +  "&c"+i+"=true";
                }
                else{
                    getter = getter +  "&c"+i+"=false";
                }
            }
            window.location.href = getter;
            
            return false;
        }
    </script>
</body>
 
</html>
