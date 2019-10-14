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
            <a href="employerdashboard.php" class="nav-link active">Hiring nav</a>
        </li>
        <li class="nav-item px-2">
            <a href="postajob.php" class="nav-link active">Hiring nav</a>
        </li>  
        <li class="nav-item px-2">
            <a href="viewEmployerHistory.php" class="nav-link active">Hiring nav</a>
        </li>
                <?php
            }
            else{
                ?>

        <li class="nav-item px-2">
            <a href="categories.php" class="nav-link active">Freelancer nav</a>
        </li>
        <li class="nav-item px-2">
            <a href="viewEmployeeHistory.php" class="nav-link active">Freelancer nav</a>
        </li>
                <?php
            }
        ?>

    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown mr-3">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <i class="fas fa-user"></i> My name
            </a>
            <div class="dropdown-menu">
                <a href="profilepage.php" class="dropdown-item">
                    <i class="fas fa-user-circle"></i> Profile
                </a>

            </div>
        </li>

        <li>
            <a href = "includes/logout.php" class = "nav-link">
                <i class ="fas fa-sign-out-alt"></i>Logout
            </a>
        </li>
    </ul>
</div>
        </div>
    </nav>
