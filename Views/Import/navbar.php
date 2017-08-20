<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Fix My Street</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li 
                    <?php
                        if($activeBar=="Home")
                            echo "class='active'";
                    ?>
                >
                    <a href="index.php">Home</a>
                </li>
                <li
                    <?php
                        if($activeBar=="Add Street")
                            echo "class='active'";
                    ?> 
                >
                    <a href="StreetController.php">Add Street</a>
                </li>
                <li>
                    <a href="#">Dhaka North</a>
                </li>
                <li>
                    <a href="#">Dhaka South</a>
                </li>
            </ul>
            
            <ul class="nav navbar-nav navbar-right">
                <?php if ($curUser) : ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <?php echo $curUser->name; ?>
                            <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="index.php">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="UserController.php?logout">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php else : ?>
                    <li <?php if($activeBar=="Login") echo "class='active'"; ?> >
                        <a href="UserController.php?login">Login</a>
                    </li>
                    <li <?php if($activeBar=="Register") echo "class='active'"; ?> >
                        <a href="UserController.php?register">Register</a>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    </div>
</nav> 