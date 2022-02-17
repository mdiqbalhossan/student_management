<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= $name; ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="dashboard.php" class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'dashboard.php')?"active":""; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="student.php" class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'student.php')?"active":""; ?>">
                        <i class="nav-icon fas fa-user-circle"></i>
                        <p>Student</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="notice.php" class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'notice.php')?"active":""; ?>">
                        <i class="nav-icon fas fa-info-circle"></i>
                        <p>Notice</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="materials.php" class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'materials.php')?"active":""; ?>">
                        <i class="nav-icon fas fa-book-open"></i>
                        <p>Materials</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="class-subject.php" class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'class-subject.php')?"active":""; ?>">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Class & Subject</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="exam.php" class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'exam.php')?"active":""; ?>">
                        <i class="nav-icon fas fa-stream"></i>
                        <p>Exam</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="schedule.php" class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'schedule.php')?"active":""; ?>">
                        <i class="nav-icon fas fa-calendar-check"></i>
                        <p>Class schedule</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="restore-student.php" class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'restore-student.php')?"active":""; ?>">
                        <i class="nav-icon fas fa-user-slash"></i>
                        <p>Restore Student</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="fees.php" class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'fees.php')?"active":""; ?>">
                        <i class="nav-icon fas fa-dollar-sign"></i>
                        <p>Fees Management</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="result.php" class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'result.php')?"active":""; ?>">
                        <i class="nav-icon fa fa-poll-h"></i>
                        <p>Result Management</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="contact.php" class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'contact.php')?"active":""; ?>">
                        <i class="nav-icon fa fa-address-book"></i>
                        <p>Contact</p>
                    </a>
                </li>

                <li class="nav-item" id="logout">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
                
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>