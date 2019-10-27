<nav class="navbar navbar-expand-sm navbar-dark bg-dark p-0">
        <div class="container">
<a href="index.php" class="navbar-brand">Freelancer</a>
<button class="navbar-toggler" data-toggle="collapse" data-target = "#navbarCollapse">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id= "navbarCollapse">
    <ul class="navbar-nav">
        
        <?php
        
            if($_SESSION["USER_TYPE"] == 0){
                ?>
        <li class="nav-item px-2">
            <a href="employerdashboard.php" class="nav-link active">Dashboard</a>
        </li>
        <li class="nav-item px-2">
            <a href="postajob.php" class="nav-link active">Post a job</a>
        </li>  

                <?php
            }
            else{
                ?>

        <li class="nav-item px-2">
            <a href="employeedashboard.php" class="nav-link active">Dashboard</a>
        </li>
        <li class="nav-item px-2">
            <a href="profilepage.php" class="nav-link active">Profile page</a>
        </li>
                <?php
            }
        ?>

    </ul>

</div>
        </div>
    </nav>
