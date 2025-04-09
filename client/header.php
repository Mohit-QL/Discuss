<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="./public/logo.png" alt="Logo" /></a>

        <div class="collapse navbar-collapse ms-4" id="navbarNav" style="font-size: 17px;">
            <ul class=" navbar-nav">

                <li class="nav-item me-3">
                    <a class="nav-link active" href="./">Home</a>
                </li>

                <?php if (empty($_SESSION['name']['name'])): ?>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="?login=true">Login</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="?signup=true">Sign Up</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item me-3">
                        <span class="nav-link" style="color: #2B2A5B;">Welcome, <?= htmlspecialchars($_SESSION['name']['name']) ?></span>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="./client/logout.php">Logout</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="?ask==true">Ask Question</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="?category=true">Category</a>
                    </li>
                <?php endif; ?>


                <li class="nav-item">
                    <a class="nav-link" href="#">Latest Questions</a>
                </li>

            </ul>
        </div>
    </div>
</nav>