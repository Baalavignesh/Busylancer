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
        <li class="nav-item px-2">
            <a href="viewAllProposalsMade.php" class="nav-link active">Proposal history</a>
        </li>
                <?php
            }
        ?>

    </ul>

    <ul class="navbar-nav ml-auto">

        <li>
            <a href = "includes/logout.php" class = "nav-link">
                <i class ="fas fa-sign-out-alt"></i>Logout
            </a>
        </li>
    </ul>

</div>
        </div>
    </nav>
