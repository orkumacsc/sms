<?php
    $StudentProfile = session('student_profile') ?? [];
    $photo = $StudentProfile['photo'] ?? null;
    $gender = $StudentProfile['gender'] ?? 1;
    $fullName = $StudentProfile['fullName'] ?? 'Student';
    $studentId = $StudentProfile['student_id'] ?? '';
    $photoPath = $photo && file_exists(public_path("storage/$photo"))
        ? asset("storage/$photo")
        : ($gender == 1
            ? asset('storage/profile-photos/default-male.jpg')
            : asset('storage/profile-photos/default-female.jpg'));
    // Example notifications array (replace with real data)
    $notifications = []; // e.g., [['message' => 'New message', 'url' => '#']]
?>

<header class="main-header">
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top pl-30">
        <!-- Sidebar toggle button-->
        <div>
            <ul class="nav">
                <li class="btn-group nav-item">
                    <a href="#" class="waves-effect waves-light nav-link rounded svg-bt-icon" data-toggle="push-menu"
                        role="button" aria-label="Toggle Sidebar">
                        <i class="nav-link-icon mdi mdi-menu"></i>
                    </a>
                </li>
                <li class="btn-group nav-item">
                    <a href="#" data-provide="fullscreen" class="waves-effect waves-light nav-link rounded svg-bt-icon"
                        title="Full Screen" aria-label="Full Screen">
                        <i class="nav-link-icon mdi mdi-crop-free"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <li class="d-flex align-items-center" style="justify-content: flex-start;">
                    <h5 class="mb-0" style="text-align: left;">
                        <?php echo e($fullName); ?><?php echo e($studentId ? ' | ' . $studentId : ''); ?>

                    </h5>
                </li>
            </ul>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <!-- Term | Academic Session -->
                <li class="d-flex align-items-center nav-item" style="justify-content: flex-end;">
                    <div>
                        <h6 class="mb-0" style="text-align: left;">
                            <?php echo e(active_term()->term_name ?? ''); ?> | <?php echo e(active_session()->name ?? ''); ?>

                        </h6>
                    </div>
                </li>
            </ul>
        </div>
        <div class="navbar-custom-menu r-side">
            <ul class="nav navbar-nav">
                <!-- Notifications -->
                <?php if(!empty($notifications)): ?>
                <li class="dropdown notifications-menu">
                    <a href="#" class="waves-effect waves-light rounded dropdown-toggle" data-toggle="dropdown"
                        title="Notifications" aria-haspopup="true" aria-expanded="false">
                        <i class="ti-bell"></i>
                    </a>
                    <ul class="dropdown-menu animated bounceIn" aria-label="Notifications">
                        <li class="header">
                            <div class="p-20">
                                <div class="flexbox">
                                    <div>
                                        <h4 class="mb-0 mt-0">Notifications</h4>
                                    </div>
                                    <div>
                                        <a href="#" class="text-danger">Clear All</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e($note['url'] ?? '#'); ?>"><?php echo e($note['message'] ?? ''); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </li>
                        <li class="footer">
                            <a href="#">View all</a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>

                <!-- User Account -->
                <li class="dropdown user user-menu">
                    <a href="javascript:void(0)" class="waves-effect waves-light rounded dropdown-toggle p-0"
                        data-toggle="dropdown" title="User" aria-haspopup="true" aria-expanded="false">
                        <img src="<?php echo e($photoPath); ?>" class="circle" alt="Staff Passport for <?php echo e($fullName); ?>" width="40" height="40">
                    </a>
                    <ul class="dropdown-menu animated flipInX" aria-label="User menu">
                        <li class="user-body">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Profile">
                                <i class="ti-user text-muted mr-2"></i> Profile
                            </a>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#ChangePassword">
                                <i class="ti-key text-muted mr-2"></i> Password
                            </a>
                            <div class="dropdown-divider"></div>
                            <!-- Logout as POST for security -->
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="ti-lock text-muted mr-2"></i> Logout
                            </a>
                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                <?php echo csrf_field(); ?>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header><?php /**PATH C:\xampp\htdocs\gospelcollege\portal.gospelschools.sch.ng\resources\views/Students/body/header.blade.php ENDPATH**/ ?>