<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="./public/logo.png" alt="Logo" /></a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link active" href="./">Home</a>
                </li>

                <?php if (empty($_SESSION['name']['name'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="?login=true">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?signup=true">Sign Up</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <span class="nav-link">Welcome, <?= htmlspecialchars($_SESSION['name']['name']) ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./client/logout.php">Logout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?ask==true">Ask Question</a>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a class="nav-link" href="#">Category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Latest Questions</a>
                </li>

            </ul>
        </div>
    </div>
</nav>
