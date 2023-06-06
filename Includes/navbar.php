<nav class="navbar navbar-expand-lg navbar-light bg-dark shadow" id="nav_top">
    <div class="container text-light">
        <div>
            <a class="navbar-sm-brand text-light text-decoration-none" href="mailto:2wearclothings@gmail.com">2wearclothings@gmail.com</a>
            <a class="navbar-sm-brand text-light text-decoration-none" href="tel:012-345-6789">012-345-6789</a>
        </div>
        <ul class="nav navbar-nav d-flex justify-content-between ml-auto ">
            <?php if(!isset($_SESSION['user'])){ ?>
            <li class="nav-item">
                <a class="nav-link text-white" href="login.php">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="register.php">Register</a>
            </li>
            <?php }else{ ?>
            <li class="nav-item">
                <a class="nav-link text-white" href="logout.php">Logout</a>
            </li>
            <?php } ?>
        </ul>

    </div>
</nav>


<header>
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand text-success logo h1 align-self-center" href="index.php">
                2WEAR
            </a>

            <div class="navbar-collapse" id="main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="shop.php">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="sell-my-clothes.php">Sell My Clothes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                        
                        
                        <?php if(isset($_SESSION['user'])){ ?>
                        <li class="nav-item">
                            <a class="nav-link" href="my-items.php">My Item Ads</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="my-profile.php">My Profile</a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>

        </div>
    </nav>
</header>