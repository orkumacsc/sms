<?php

$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();

?>

<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">	
		
        <div class="user-profile">
          <div class="ulogo">
            <a href="<?php echo e(route('staff.dashboard')); ?>">
              <!-- logo for regular state and mobile devices -->
              <div class="d-flex align-items-center justify-content-center">					 	
                  <img src="<?php echo e(asset('backend/images/logo-dark.png')); ?>" alt="School Logo">                  
              </div>
            </a>
          </div>
        </div>
      
      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree"> 
		    <li class=" <?php echo e(($route == 'staff.dashboard')? 'active' : ''); ?> ">
          <a href="<?php echo e(route('staff.dashboard')); ?>">
            <i data-feather="pie-chart"></i>
			      <span>Dashboard</span>
          </a>
        </li>        
        
        
      </ul>
    </section>
  </aside>
<?php /**PATH C:\xampp\htdocs\gospelcollege\portal.gospelschools.sch.ng\resources\views/Teachers/body/sidebar.blade.php ENDPATH**/ ?>