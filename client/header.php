<nav class="navbar navbar-expand-lg navbar-light bg-light">

    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between mx-auto w-100" style="max-width: 1698px;padding: 10px 0;">

            <div>
                <a class="navbar-brand" href="./">
                    <img src="./public/logo.png" alt="Logo" />
                </a>
            </div>

            <div class="collapse navbar-collapse ms-4" id="navbarNav" style="font-size: 17px;">
                <ul class="navbar-nav d-flex flex-wrap">
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
                            <a class="nav-link" href="?ask=true">Ask Question</a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link" href="?category=true">Category</a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link" href="?myquestions=true">My Questions</a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item">
                        <a class="nav-link" href="?latest=true">Latest Questions</a>
                    </li>
                </ul>
            </div>

            <div>
                <form class="d-flex" action="?search=true" method="GET">
                    <input class="form-control me-2" type="search" name="q" placeholder="Search questions...">
                    <input type="hidden" name="search" value="true">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </form>
            </div>

        </div>
    </div>

</nav>