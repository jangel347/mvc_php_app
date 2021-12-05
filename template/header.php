<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand font-weight-bold text-white">MCV_APP</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo Config::VIEW_PATH . 'dashboard.php' ?>">Menu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo Config::VIEW_PATH . 'list_areas.php' ?>">Areas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo Config::VIEW_PATH . 'list_employees.php' ?>">Employees</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo Config::VIEW_PATH . 'list_jobs.php' ?>">Jobs</a>
            </li>
        </ul>
    </div>
</nav>